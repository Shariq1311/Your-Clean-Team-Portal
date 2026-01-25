<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use MojarCMS\Backend\Http\Datatables\EmailTemplateDataTable;
use MojarCMS\Backend\Models\EmailTemplate;
use MojarCMS\CMS\Contracts\HookActionContract;
use MojarCMS\CMS\Http\Controllers\BackendController;
use Illuminate\Database\Eloquent\Model;
use MojarCMS\CMS\Traits\ResourceController;

class EmailTemplateController extends BackendController
{
    use ResourceController;

    protected string $editKey = 'code';

    protected string $viewPrefix = 'cms::backend.email_template';

    public function __construct(protected HookActionContract $hookAction) {}

    protected function getDetailModel(Model $model, ...$params): Model
    {
        $code = $this->getPathId($params);
        $model = $model->where($this->editKey ?? 'id', $this->getPathId($params))->firstOrNew();

        if ($model->id === null) {
            $template = $this->hookAction->getEmailTemplates($code);
            
            // Check if template exists
            if ($template && $template->get('body')) {
                try {
                    // Try to get the template view path
                    $viewPath = view($template->get('body'))->getPath();
                    if (File::exists($viewPath)) {
                        $template->put('body', File::get($viewPath));
                        $model->fill($template->toArray());
                    }
                } catch (\Exception $e) {
                    // If there's an error, log it but don't break the flow
                    \Log::error("Error loading email template: " . $e->getMessage(), [
                        'code' => $code,
                        'template' => $template->toArray() ?? []
                    ]);
                    
                    // Set default values to prevent errors
                    $model->fill([
                        'code' => $code,
                        'subject' => $code,
                        'body' => ''
                    ]);
                }
            } else {
                // Set default values if template doesn't exist
                $model->fill([
                    'code' => $code,
                    'subject' => $code,
                    'body' => ''
                ]);
            }
        }
        return $model;
    }

    protected function getDataTable(...$params): EmailTemplateDataTable
    {
        return EmailTemplateDataTable::make();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Contracts\Validation\Validator
    {
        $code = $attributes['code'] ?? null;

        return Validator::make(
            $attributes,
            [
                'subject' => ['required'],
                'body' => ['required'],
                'code' => [
                    'required',
                    'max:50',
                    'regex:/([a-z0-9\_]+)/',
                    Rule::modelUnique(
                        EmailTemplate::class,
                        'code',
                        function (Builder $q) use ($code) {
                            $q->where("{$q->getModel()->getTable()}.code", '!=', $code);
                        }
                    ),
                ],
            ]
        );
    }

    protected function getModel(...$params): string
    {
        return EmailTemplate::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('cms::app.email_templates');
    }
}
