<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\CMS\Contracts;

interface BackendMessageContract
{
    public function all(): array;

    public function add(string $group, array|string $message, string $status): void;

    public function delete(string $id): bool;

    public function deleteGroup(string $group): bool;
}
