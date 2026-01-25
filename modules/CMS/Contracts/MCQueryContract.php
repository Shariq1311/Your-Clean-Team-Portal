<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com/cms
 * @license    MIT
 */

namespace MojarCMS\CMS\Contracts;

use Illuminate\Support\Collection;

interface MCQueryContract
{
    public function queryRows(string $table, array $args = []): Collection|null;

    public function queryRow(string $table, array $args = []): object|null;

    public function postTaxonomies(array|object $post, string $taxonomy = null, array $params = []): array;

    public function relatedPosts(array|object $post, int $limit = 5, string $taxonomy = null): array;

    public function postTaxonomy(array|object $post, string $taxonomy = null, array $params = []): mixed;
}
