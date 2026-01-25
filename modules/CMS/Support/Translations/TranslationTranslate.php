<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\CMS\Support\Translations;

use Closure;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use MojarCMS\CMS\Contracts\GoogleTranslate;
use MojarCMS\CMS\Contracts\TranslationManager;
use MojarCMS\CMS\Models\Translation;

class TranslationTranslate
{
    protected string $source;
    protected string $target;
    protected array $errors = [];
    protected int $progressSleep = 1;
    protected Closure $progressCallback;
    protected Collection $translationLines;

    public function __construct(
        protected Collection $module,
        protected GoogleTranslate $googleTranslate,
        protected TranslationManager $translationManager
    ) {}

    public function run(): int
    {
        $this->errors = [];
        $trans = $this->getTranslationLines();

        $total = 0;
        foreach ($trans as $tran) {
            $value = $this->googleTranslate->translate(
                $this->source,
                $this->target,
                $tran->value
            );

            if (empty($value)) {
                $this->errors[] = "Translate {$tran->value} fail";
                continue;
            }

            $newTran = $this->translationManager->importTranslationLine(
                [
                    'locale' => $this->target,
                    'group' => $tran->group,
                    'namespace' => $tran->namespace,
                    'key' => $tran->key,
                    'object_type' => $tran->object_type,
                    'object_key' => $tran->object_key,
                    'value' => $value
                ]
            );

            if (isset($this->progressCallback)) {
                call_user_func($this->progressCallback, $newTran);
            }

            if ($newTran->wasRecentlyCreated) {
                $total += 1;
            }

            sleep($this->progressSleep);
        }

        return $total;
    }

    public function getTranslationLines(): Collection
    {
        if (isset($this->translationLines)) {
            return $this->translationLines;
        }

        $this->translationLines = Translation::from('mc_translations AS a')
            ->where('locale', '=', $this->source)
            ->where('object_type', '=', $this->module->get('type'))
            ->where('object_key', '=', $this->module->get('key'))
            ->whereNotExists(
                function (Builder $q) {
                    $q->select(['id'])
                        ->from('mc_translations AS b')
                        ->where('locale', '=', $this->target)
                        ->whereColumn('a.group', '=', 'b.group')
                        ->whereColumn('a.namespace', '=', 'b.namespace')
                        ->whereColumn('a.key', '=', 'b.key')
                        ->whereColumn('a.object_type', '=', 'b.object_type')
                        ->whereColumn('a.object_key', '=', 'b.object_key');
                }
            )
            ->get();

        return $this->translationLines;
    }

    public function progressCallback(Closure $progressCallback): static
    {
        $this->progressCallback = $progressCallback;

        return $this;
    }

    public function setSource(string $source): static
    {
        $this->source = $source;

        return $this;
    }

    public function setTarget(string $target): static
    {
        $this->target = $target;

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
