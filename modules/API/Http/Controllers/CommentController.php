<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    GNU General Public License v2.0
 */

namespace MojarCMS\API\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MojarCMS\Backend\Http\Resources\CommentResource;
use MojarCMS\Backend\Repositories\CommentRepository;
use MojarCMS\Backend\Repositories\PostRepository;
use MojarCMS\CMS\Facades\HookAction;
use MojarCMS\CMS\Http\Controllers\ApiController;
use MojarCMS\Frontend\Http\Requests\CommentRequest;

class CommentController extends ApiController
{
    public function __construct(
        protected CommentRepository $commentRepository,
        protected PostRepository    $postRepository
    ) {}

    public function index(Request $request, $type, $slug): AnonymousResourceCollection
    {
        //$this->postRepository->pushCriteria(new SearchCriteria($request));

        //$this->postRepository->pushCriteria(new FilterCriteria($request));

        $post = $this->postRepository->findBySlug($slug);

        if ($post->type != $type) {
            abort(403);
        }

        $result = $this->commentRepository->getFrontendPostComments(
            $post,
            $this->getQueryLimit($request)
        );

        return CommentResource::collection($result);
    }

    /**
     * @throws \Throwable
     */
    public function store(CommentRequest $request, $type, $slug): \Illuminate\Http\JsonResponse
    {
        $post = $this->postRepository->findBySlug($slug);

        $postType = HookAction::getPostTypes($type);

        if (!in_array('comment', $postType->get('supports', []))) {
            return $this->restFail(
                [
                    [
                        'code' => 403,
                        'message' => __('Comments is not supported.')
                    ]
                ],
                __('Comments is not supported.')
            );
        }

        DB::beginTransaction();
        try {
            $data = $request->all();
            $data['object_id'] = $post->id;
            $data['object_type'] = Str::plural($type);
            $comment = $this->commentRepository->create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        do_action('post_type.comment.saved', $comment, $post);

        return $this->restSuccess(null, trans('cms::app.comment_success'));
    }
}
