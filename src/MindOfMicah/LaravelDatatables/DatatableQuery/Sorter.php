<?php

namespace MindOfMicah\LaravelDatatables\DatatableQuery;

class Sorter
{
    private $column_index;
    private $direction;

    public function __construct($column_index, $direction = 'ASC')
    {
        $this->column_index = $column_index;
        $this->direction = $direction;
    }

    public function toArray()
    {
        return [
            'col' => $this->column_index,
            'dir' => strtolower($this->direction)
        ];
    }
}
