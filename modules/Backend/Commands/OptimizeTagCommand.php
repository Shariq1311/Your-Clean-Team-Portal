<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use MojarCMS\Backend\Http\Resources\TaxonomyResource;
use MojarCMS\Backend\Models\Post;

class OptimizeTagCommand extends Command
{
    protected $name = 'Mojarcms:optimize-tags';

    public function handle(): void
    {
        $termQuery = DB::table('term_taxonomies')
            ->select(['term_id'])
            ->join('taxonomies', 'taxonomies.id', 'term_taxonomies.taxonomy_id')
            ->where('taxonomies.taxonomy', '=', 'tags')
            ->groupBy(['term_id'])
            ->having(DB::raw('COUNT(term_id)'), '>', 10);

        Post::whereIn('id', $termQuery)
            ->chunkById(
                300,
                function ($posts) {
                    foreach ($posts as $post) {
                        /** @var Post $post */
                        DB::beginTransaction();
                        try {
                            $tags = $post->taxonomies()
                                ->where('taxonomy', '=', 'tags')
                                ->limit(10)
                                ->get(['id'])
                                ->pluck('id')
                                ->toArray();

                            $post->syncTaxonomy('tags', ['tags' => $tags]);

                            $post->update(
                                [
                                    'json_taxonomies' => TaxonomyResource::collection($post->taxonomies()->get())
                                        ->toArray(request())
                                ]
                            );

                            DB::commit();
                        } catch (\Throwable $e) {
                            DB::rollBack();
                            throw $e;
                        }

                        $this->info("Optimize tags post id {$post->id}");
                    }
                }
            );
    }
}
