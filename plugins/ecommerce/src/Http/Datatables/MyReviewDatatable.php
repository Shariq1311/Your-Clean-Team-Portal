<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use MojarCMS\CMS\Abstracts\DataTable;
use MojarCMS\Backend\Models\Comment;
use MojarCMS\Backend\Models\Post;

class MyReviewDatatable extends DataTable
{
    /**
     * Columns to display
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'product' => [
                'label' => trans('ecomm::content.product'),
                'formatter' => [$this, 'productFormatter'],
                'width' => '30%',
            ],
            'content' => [
                'label' => trans('ecomm::content.review'),
                'formatter' => function($value, $row) {
                    return '<div class="text-wrap" style="max-width: 300px;">' . e($value) . '</div>';
                },
                'width' => '25%',
            ],
            'rating' => [
                'label' => trans('ecomm::content.rating'),
                'sortable' => false,
                'formatter' => function($value, $row) {
                    return $this->getRatingStars($row->rating);
                },
                'width' => '15%',
            ],
            'status' => [
                'label' => trans('ecomm::content.status'),
                'formatter' => function($value, $row) {
                    return $this->getStatusBadge($value);
                },
                'width' => '10%',
            ],
            'created_at' => [
                'label' => trans('ecomm::content.review_date'),
                'formatter' => function($value, $row) {
                    return mc_date_format($value);
                },
                'width' => '15%',
            ],
            'operations' => [
                'label' => trans('cms::app.operations'),
                'width' => '10%',
                'align' => 'center',
                'sortable' => false,
                'formatter' => function ($value, $row, $index) {
                    return view(
                        'cms::backend.items.datatable_item',
                        [
                            'value' => $row->id,
                            'row' => $row,
                            'actions' => $this->rowAction($row),
                            'editUrl' => $this->currentUrl . '/' . $row->id . '/edit',
                            'title_hidden' => true,
                            'actions_hidden' => false,
                        ]
                    )
                    ->render();
                },
            ]
        ];
    }

    /**
     * Query data
     *
     * @param array $data
     * @return Builder
     */
    public function query($data): Builder
    {
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        $query = Comment::query()
            ->where('user_id', $user->id)
            ->where('object_type', 'products')
            ->whereRaw("JSON_EXTRACT(json_metas, '$.rating') IS NOT NULL");
            
        // Search functionality
        if ($keyword = $data['keyword'] ?? null) {
            $query->where(function($q) use ($keyword) {
                $q->where('content', 'LIKE', "%{$keyword}%");
            });
        }

        // Status filter
        if ($status = $data['status'] ?? null) {
            $query->where('status', '=', $status);
        }

        return $query;
    }
    
    /**
     * Format the product column with thumbnail
     *
     * @param $value
     * @param $row
     * @return string
     */
    public function productFormatter($value, $row): string
    {
        $post = Post::find($row->object_id);
        
        if (!$post) {
            return '<div class="d-flex align-items-center">
                        <div class="avatar bg-secondary">-</div>
                        <div class="ms-2">
                            <div class="font-weight-medium">' . trans('ecomm::content.deleted_product') . '</div>
                        </div>
                    </div>';
        }
        
        $thumbnail = empty($post->thumbnail) 
            ? '<div class="avatar bg-secondary">-</div>'
            : '<img src="' . upload_url($post->thumbnail) . '" class="avatar" alt="Product" />';
            
        // Construct URL manually for product
        $productUrl = url($post->type . '/' . $post->slug);

        return '<div class="d-flex align-items-center">
                    ' . $thumbnail . '
                    <div class="ms-2">
                        <div class="font-weight-medium"><a href="' . $productUrl . '" target="_blank">' . $post->title . '</a></div>
                        <div class="text-muted small">' . $post->type . '</div>
                    </div>
                </div>';
    }

    /**
     * Row action template
     *
     * @param $row
     * @return array
     */
    public function rowAction($row): array
    {

        return [
            'edit' => [
                'label' => trans('cms::app.edit'),
                'url' => route('admin.ecommerce.my-reviews.edit', $row->id),
            ],
            'delete' => [
                'label' => trans('cms::app.delete'),
                'class' => 'text-danger',
                'action' => 'delete',
            ],
        ];
    }
    
    /**
     * Get rating stars HTML
     *
     * @param int $rating
     * @return string
     */
    private function getRatingStars(int $rating): string
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $stars .= '<i class="far fa-star text-muted"></i>';
            }
        }
        return $stars;
    }
    
    /**
     * Get status badge HTML
     *
     * @param string $status
     * @return string
     */
    private function getStatusBadge(string $status): string
    {
        $badges = [
            'approved' => '<span class="badge bg-success">Approved</span>',
            'pending' => '<span class="badge bg-warning">Pending</span>',
            'deny' => '<span class="badge bg-danger">Denied</span>',
            'trash' => '<span class="badge bg-secondary">Trash</span>',
        ];
        return $badges[$status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }
    
    /**
     * Override the getData method to add the rating from json_metas
     */
    public function getData(\Illuminate\Http\Request $request): array
    {
        [$total, $rows] = parent::getData($request);
        
        // Add rating from json_metas to each row
        foreach ($rows as $row) {
            $row->rating = $this->getRating($row);
        }
        
        return [$total, $rows];
    }
    
    /**
     * Get rating from json_metas
     *
     * @param object $row
     * @return int
     */
    private function getRating($row): int
    {
        if (isset($row->json_metas) && is_array($row->json_metas)) {
            return (int) ($row->json_metas['rating'] ?? 0);
        }
        
        if (isset($row->json_metas) && is_string($row->json_metas)) {
            $metas = json_decode($row->json_metas, true);
            return (int) ($metas['rating'] ?? 0);
        }
        
        return 0;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                Comment::destroy($ids);
                break;
        }
    }
}
