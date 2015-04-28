<?php

namespace MindOfMicah\LaravelDatatables\DatatableQuery;

class Column
{
    
    public $data='', $name='', $searchable='true', $orderable='true', $search=['value'=>'','regex'=>'false'];

    public function toArray()
    {
         return [
            'data'=>$this->data,
            'name'=>$this->name,
            'searchable'=>$this->searchable,
            'orderable'=>$this->orderable,
            'search'=>$this->search
        ];
    }
}
