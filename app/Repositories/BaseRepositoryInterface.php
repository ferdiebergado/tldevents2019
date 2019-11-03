<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    /**
     * Find a Model by its Primary Key.
     *
     * @param integer $id
     */
    public function find(int $id);

    /**
     * Create a new Model.
     *
     * @param array $attributes
     */
    public function create(array $attributes);

    /**
     * Create or return a model instance that match an array of attributes.
     *
     * @param array $attributesToCheck
     * @param array $attributes
     */
    public function firstOrCreate(array $attributesToCheck, array $attributes);

    /**
     * Update a model.
     *
     * @param integer $id
     * @param array $attributes
     */
    public function update(int $id, array $attributes);

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     */
    public function updateOrCreate($attributes, $values);

    /**
     * Search 
     *
     * @param string $search
     */
    public function search(string $search);
}
