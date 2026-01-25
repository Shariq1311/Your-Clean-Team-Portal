<?php

/**
 * Mojar - The Best CMS for Laravel Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team <admin@Mojar.com>
 * @link       https://Mojar.com
 * @license    MIT
 */

namespace MojarCMS\CMS\Contracts;

interface MojarApiContract
{
    public function login(string $email, string $password): bool;

    public function checkActivationCode(string $module, string $name, string $code): object;

    public function getActivationCodes(string $module, string $name): object;

    public function setAccessToken(string $accessToken): void;

    public function getAccessToken(): ?string;

    public function get(string $uri, array $params = [], array $headers = []): object|array;
}
