<?php

namespace MojarCMS\Backend\Repositories;

use MojarCMS\Backend\Models\Comment;
use MojarCMS\Backend\Models\Post;
use MojarCMS\CMS\Repositories\BaseRepositoryEloquent;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace MojarCMS\Backend\Repositories;
 */
class CommentRepositoryEloquent extends BaseRepositoryEloquent implements CommentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Comment::class;
    }

    public function getFrontendPostComments(Post $post, int $limit)
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->newQuery()
            ->where(['object_id' => $post->id])
            ->whereApproved()
            ->paginate($limit);

        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($result);
    }
}
