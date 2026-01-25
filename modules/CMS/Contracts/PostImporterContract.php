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

use MojarCMS\Backend\Models\Post;

/**
 * @see \MojarCMS\CMS\Support\Imports\PostImporter
 */
interface PostImporterContract
{
    public function setCreatedBy(int $createdBy): static;

    public function getCreatedBy(): ?int;

    public function setDownloadThumbnail(bool $downloadThumbnai): static;

    public function getDownloadThumbnail(): bool;

    public function setDownloadContentImages(bool $download): static;

    public function getDownloadContentImages(): bool;

    public function import(array $data, array $options = []): Post;
}
