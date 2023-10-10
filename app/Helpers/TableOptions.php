<?php

namespace App\Helpers;

use PhpParser\Builder\Class_;

class TableOptions
{
    /**
     * Model class .
     */
    public $model;

    /**
     * Display name of the table.
     *
     * @var string
     */
    public $displayName;

    /**
     * The main query before processing the model.
     *
     * @var callable
     */
    public $query;

    /**
     * Column List.
     *
     * @var array
     */
    public $columns;

    /**
     * Table sort order.
     *
     * @var array
     */
    public $orderBy;

    /**
     * User permissions to show the allowed action on the table.
     *
     * @var array
     */
    public $authPermissions;

    /**
     * Columns allowed search
     *
     * @var array
     */
    public $searchable;

    /**
     * Columns allowed  sort
     *
     * @var array
     */
    public $sortable;


    /**
     * Model class
     */
    function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Register the typical authentication routes for an application.
     *
     * @return string
     *
     */
    public function handle()
    {
        dd($this->authPermissions);

        return 'it\'s work!';
    }
}
