<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\Network\Support;

use Illuminate\Support\Str;
use MojarCMS\CMS\Models\User;
use MojarCMS\Network\Contracts\NetworkSiteContract;
use MojarCMS\Network\Models\Site;

class NetworkSite implements NetworkSiteContract
{
    protected Site $site;

    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    public function getLoginUrl(User $user): string
    {
        $random = Str::random(5);
        $loginUrl = $this->getUrl(config('Mojar.admin_prefix'));
        $string = "{$loginUrl}/{$random}";
        $token = generate_token($string);
        $user = encrypt(json_encode(['id' => $user->id]));

        $data = [
            'token' => $token,
            'auth' => urldecode($string),
            'user' => urlencode($user)
        ];

        return $loginUrl . '/token-login?' . http_build_query($data);
    }

    public function getUrl(string $path = null): string
    {
        return $this->site->getSiteUrl($path);
    }
}
