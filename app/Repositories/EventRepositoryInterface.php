<?php

namespace App\Repositories;

interface EventRepositoryInterface
{
    /**
     * Find the active event by the authenticated user.
     */
    public function activeByAuthUser();

    /**
     * Get all events sorted by timestamp.
     *
     * @param string $timestamp
     */
    public function latest(string $timestamp = 'created_at');
}
