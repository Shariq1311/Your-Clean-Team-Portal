<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Tests\Feature\Frontend;

use MojarCMS\Backend\Models\Taxonomy;
use MojarCMS\CMS\Facades\HookAction;
use MojarCMS\Tests\TestCase;

class TaxonomyTest extends TestCase
{
    public function testTaxonomy()
    {
        $taxonomies = HookAction::getTaxonomies();
        foreach ($taxonomies as $types) {
            foreach ($types as $key => $taxonomy) {
                $data = Taxonomy::where('taxonomy', '=', $key)
                    ->first();
                if (empty($data)) {
                    continue;
                }

                $permalink = HookAction::getPermalinks($key);
                $base = $permalink->get('base');

                $url = "/{$base}/{$data->slug}";
                $response = $this->get($url);

                $this->printText("Test {$url}");

                $response->assertStatus(200);
            }
        }
    }
}
