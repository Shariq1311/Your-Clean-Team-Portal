<?php

declare(strict_types=1);

namespace Mojahid\ChatbotIntegration\Http\Datatables;

use Illuminate\Database\Eloquent\Builder;
use MojarCMS\CMS\Abstracts\DataTable;
use Mojahid\ChatbotIntegration\Models\ChatbotConfiguration;

final class ChatbotConfigurationDatatable extends DataTable
{
    /**
     * Columns datatable
     */
    public function columns(): array
    {
        return [
            'name' => [
                'label' => trans('chatbot-integration::app.provider'),
                'width' => '15%',
                'formatter' => function ($value, $row, $index) {
                    return '<div class="d-flex align-items-center">
                        <div class="avatar avatar-sm me-3">
                            <div class="avatar-title bg-primary rounded-circle">
                                ' . strtoupper(substr($row->display_name, 0, 2)) . '
                            </div>
                        </div>
                        <div>
                            <div class="fw-bold">' . e($row->display_name) . '</div>
                            <div class="text-muted small">' . e($value) . '</div>
                        </div>
                    </div>';
                }
            ],
            'description' => [
                'label' => trans('cms::app.description'),
                'width' => '35%',
                'formatter' => function ($value, $row, $index) {
                    $description = e($value ?: '—');
                    $capabilities = collect($row->capabilities ?? [])
                        ->filter()
                        ->keys()
                        ->map(fn($cap) => '<span class="badge bg-light text-dark me-1">' . str_replace('_', ' ', $cap) . '</span>')
                        ->take(5)
                        ->implode('');
                    
                    return '<div>
                        <div class="mb-1">' . $description . '</div>
                        <div class="capabilities">' . $capabilities . '</div>
                    </div>';
                }
            ],
            'status' => [
                'label' => trans('cms::app.status'),
                'width' => '15%',
                'formatter' => function ($value, $row, $index) {
                    $statusClass = $row->status_color;
                    $statusText = $row->display_status;
                    
                    $html = '<span class="badge bg-' . $statusClass . '">' . $statusText . '</span>';
                    
                    if ($row->last_error) {
                        $html .= '<div class="text-danger small mt-1" title="' . e($row->last_error) . '">
                            <i class="fa fa-exclamation-triangle"></i> Error
                        </div>';
                    }
                    
                    if ($row->last_tested_at) {
                        $html .= '<div class="text-muted small">
                            Tested: ' . $row->last_tested_at->diffForHumans() . '
                        </div>';
                    }
                    
                    return $html;
                }
            ],
            'sort_order' => [
                'label' => trans('cms::app.sort_order'),
                'width' => '10%',
                'align' => 'center'
            ],
            'updated_at' => [
                'label' => trans('cms::app.updated_at'),
                'width' => '15%',
                'formatter' => function ($value, $row, $index) {
                    return mc_date_format($value);
                }
            ],
            'id' => [
                'label' => trans('cms::app.actions'),
                'width' => '10%',
                'formatter' => function ($value, $row, $index) {
                    return view('chatbot-integration::backend.configurations.components.actions', [
                        'row' => $row
                    ])->render();
                }
            ]
        ];
    }

    /**
     * Query data datatable
     */
    public function query($params): Builder
    {
        $query = ChatbotConfiguration::query()
            ->select([
                'id',
                'name',
                'display_name', 
                'description',
                'config',
                'capabilities',
                'is_active',
                'sort_order',
                'status',
                'last_tested_at',
                'last_error',
                'updated_at'
            ]);

        if ($params['status'] ?? null) {
            $query->where('status', '=', $params['status']);
        }

        if ($params['is_active'] ?? null) {
            $query->where('is_active', '=', $params['is_active'] === 'true');
        }

        if ($params['search'] ?? null) {
            $query->where(function ($subQuery) use ($params) {
                $subQuery->where('name', 'like', '%' . $params['search'] . '%')
                    ->orWhere('display_name', 'like', '%' . $params['search'] . '%')
                    ->orWhere('description', 'like', '%' . $params['search'] . '%');
            });
        }

        return $query->ordered();
    }

    public function actions(): array
    {
        return [
            'activate' => [
                'label' => trans('chatbot-integration::app.activate'),
            ],
            'deactivate' => [
                'label' => trans('chatbot-integration::app.deactivate'),
            ],
            'test' => [
                'label' => trans('chatbot-integration::app.test_connection'),
            ],
            'delete' => [
                'label' => trans('cms::app.delete'),
            ]
        ];
    }

    public function bulkActions($action, $ids)
    {
        $configurations = ChatbotConfiguration::whereIn('id', $ids)->get();
        
        foreach ($configurations as $config) {
            switch ($action) {
                case 'activate':
                    $config->update(['is_active' => true]);
                    break;
                case 'deactivate':
                    $config->update(['is_active' => false]);
                    break;
                case 'test':
                    // Test connection and update status
                    $chatbotManager = app(\Mojahid\ChatbotIntegration\Supports\ChatbotManager::class);
                    try {
                        $provider = $chatbotManager->driver($config->name);
                        $provider->configure($config->config ?? []);
                        $success = $provider->testConnection();
                        $config->markAsTested($success, $success ? null : 'Connection test failed');
                        $config->save();
                    } catch (\Exception $e) {
                        $config->markAsTested(false, $e->getMessage());
                        $config->save();
                    }
                    break;
                case 'delete':
                    $config->delete();
                    break;
            }
        }
    }

    public function searchFields(): array
    {
        return [
            'status' => [
                'type' => 'select',
                'label' => trans('cms::app.status'),
                'options' => [
                    '' => trans('cms::app.all'),
                    'active' => trans('chatbot-integration::app.active'),
                    'inactive' => trans('chatbot-integration::app.inactive'),
                    'error' => trans('chatbot-integration::app.error')
                ]
            ],
            'is_active' => [
                'type' => 'select',
                'label' => trans('chatbot-integration::app.enabled'),
                'options' => [
                    '' => trans('cms::app.all'),
                    'true' => trans('cms::app.enabled'),
                    'false' => trans('cms::app.disabled')
                ]
            ]
        ];
    }

    /**
     * Get permission prefix
     */
    public function getPermissionPrefix(): string
    {
        return 'chatbots';
    }
} 