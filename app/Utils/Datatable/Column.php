<?php

namespace App\Utils\Datatable;

use Illuminate\Support\Fluent;

class Column
{
    public static function make(string $label = '')
    {
        $fluent = new Fluent();

        $fluent->label = $label;
        $fluent->key = '';
        $fluent->type = 'data';
        $fluent->theme = null;
        $fluent->view = null;
        $fluent->headingClasses = '';
        $fluent->rowClasses = '';
        $fluent->width = null;
        $fluent->format = null;
        $fluent->colors = [];

        return $fluent;
    }
}
