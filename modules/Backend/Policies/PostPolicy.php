<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    Mojar/cms
 * @author     Mojar Team
 * @link       https://Mojar.com/cms
 * @license    GNU V2
 */

namespace MojarCMS\Backend\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use MojarCMS\CMS\Models\Model;
use MojarCMS\CMS\Models\User;

class PostPolicy
{
    use HandlesAuthorization;

    public function index(User $user, $type): bool
    {
        if (!$user->can("post-type.{$type}.index")) {
            return false;
        }

        return true;
    }

    public function edit(User $user, Model $model, $type): bool
    {
        if (!$user->can("post-type.{$type}.edit")) {
            return false;
        }

        return true;
    }

    public function create(User $user, $type): bool
    {
        if (!$user->can("post-type.{$type}.create")) {
            return false;
        }

        return true;
    }

    public function delete(User $user, Model $model, $type): bool
    {
        if (!$user->can("post-type.{$type}.delete")) {
            return false;
        }

        return true;
    }

    public function apiIndex(?User $user, $type): bool
    {
        if (!$user?->can("api.post-type.{$type}.index")) {
            return false;
        }

        return true;
    }

    public function apiCreate(?User $user, $type): bool
    {
        if (!$user?->can("api.post-type.{$type}.create")) {
            return false;
        }

        return true;
    }

    public function apiEdit(?User $user, $type): bool
    {
        if (!$user?->can("api.post-type.{$type}.edit")) {
            return false;
        }

        return true;
    }

    public function apiDelete(?User $user, $type): bool
    {
        if (!$user?->can("api.post-type.{$type}.delete")) {
            return false;
        }

        return true;
    }
}
