<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use MojarCMS\CMS\Http\Controllers\BackendController;
use MojarCMS\Backend\Models\Comment;
use Illuminate\Support\Facades\Auth;
use MojarCMS\Backend\Models\Post;
use Mojahid\Ecommerce\Http\Datatables\MyReviewDatatable;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Models\OrderItem;

class MyReviewController extends BackendController
{
    public function create(): View
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        
        // Get only products that the user has ordered
        $orderedProductIds = OrderItem::select('post_id')
            ->whereHas('order', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->distinct()
            ->pluck('post_id')
            ->toArray();
            
        $products = Post::where('type', 'products')
            ->where('status', 'publish')
            ->whereIn('id', $orderedProductIds)
            ->orderBy('title')
            ->get(['id', 'title']);
            
        // Check if the user has already reviewed any of these products
        $reviewedProductIds = Comment::where('user_id', $user->id)
            ->where('object_type', 'products')
            ->whereRaw("JSON_EXTRACT(json_metas, '$.rating') IS NOT NULL")
            ->pluck('object_id')
            ->toArray();
            
        return view('ecomm::backend.my-review.create', [
            'products' => $products,
            'reviewedProductIds' => $reviewedProductIds,
            'title' => trans('ecomm::content.add_review'),
        ]);
    }
    
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'object_id' => 'required|exists:posts,id',
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);
        
        $post = Post::findOrFail($request->input('object_id'));
        
        // Check if user already reviewed this product
        $existingReview = Comment::where('user_id', $user->id)
            ->where('object_id', $post->id)
            ->where('object_type', 'products')
            ->whereRaw("JSON_EXTRACT(json_metas, '$.rating') IS NOT NULL")
            ->first();
            
        if ($existingReview) {
            return redirect()->route('admin.ecommerce.my-reviews.edit', $existingReview->id)
                ->with('error', trans('ecomm::content.already_reviewed'));
        }
        
        // Create the comment
        $comment = Comment::create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
            'object_id' => $post->id,
            'object_type' => 'products',
            'status' => 'pending', // Default to pending for admin approval
            'json_metas' => [
                'rating' => $request->input('rating'),
            ],
        ]);
        
        return redirect()->route('admin.ecommerce.my-reviews.index')
            ->with('success', trans('ecomm::content.review_submitted'));
    }

    public function index(): View
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $dataTable = new MyReviewDatatable();

        return view('ecomm::backend.my-review.index', [
            'dataTable' => $dataTable,
            'title' => trans('ecomm::content.my_reviews'),
        ]);
    }

    public function datatable(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $dataTable = new MyReviewDatatable();
        return $dataTable->ajax($request);
    }

    public function edit($id): View
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $review = Comment::where('id', $id)
            ->where('user_id', $user->id)
            ->where('object_type', 'products')
            ->whereRaw("JSON_EXTRACT(json_metas, '$.rating') IS NOT NULL")
            ->firstOrFail();

        $post = Post::find($review->object_id);

        return view('ecomm::backend.my-review.edit', [
            'review' => $review,
            'post' => $post,
            'title' => trans('ecomm::content.edit_review'),
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $review = Comment::where('id', $id)
            ->where('user_id', $user->id)
            ->where('object_type', 'products')
            ->whereRaw("JSON_EXTRACT(json_metas, '$.rating') IS NOT NULL")
            ->firstOrFail();

        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $jsonMetas = $review->json_metas;
        $jsonMetas['rating'] = $request->input('rating');

        $review->update([
            'content' => $request->input('content'),
            'json_metas' => $jsonMetas,
        ]);

        return redirect()->route('admin.ecommerce.my-reviews.index')
            ->with('success', trans('ecomm::content.review_updated'));
    }

    public function destroy($id): JsonResponse
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $review = Comment::where('id', $id)
            ->where('user_id', $user->id)
            ->where('object_type', 'products')
            ->whereRaw("JSON_EXTRACT(json_metas, '$.rating') IS NOT NULL")
            ->first();

        if (!$review) {
            return response()->json(['error' => 'Review not found'], 404);
        }

        $review->delete();

        return response()->json([
            'success' => true,
            'message' => trans('ecomm::content.review_deleted'),
        ]);
    }


}
