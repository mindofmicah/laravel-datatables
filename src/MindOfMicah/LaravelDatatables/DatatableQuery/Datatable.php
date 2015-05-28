<?php

namespace MindOfMicah\LaravelDatatables\DatatableQuery;

class Datatable
{
    public $columns = [];

    public $sorting = [];
    public $limit = 10;
    public $start = 0;
    public $search_term;

    public function addDummyColumns($how_many)
    {
        foreach(range(1, intval($how_many)) as $index) {
            $this->addColumn();
        }
        return $this;
    }
    public function addNamedColumns()
    {
        foreach(func_get_args() as $name) {
            $column = new Column;
            $column->name = $name;
            $this->addColumn($column);
        }
        return $this;
    }
    private function addColumn(Column $column = null)
    {
        $column = $column ?: new Column;
        $column->data = count($this->columns);
        $this->columns[] = $column;
        return $this;
    }
    private function formatColumns()
    {
        return array_reduce($this->columns, function ($c, Column $column) {$c[] = $column->toArray();return $c;}, []);
    }

    public function formatSearch()
    {
        return array (
            'value' => $this->search_term,
            'regex' => 'false',
        );
    }
    private function formatSorting()
    {
        return array_map(function (Sorter $s) {
            return $s->toArray();
        }, $this->sorting);
    }

    public function __toString()
    {
$data = 
array (
  'draw' => '1',
  'columns' => $this->formatColumns(), 
  'order' => $this->formatSorting(), 
  'start' => $this->start,
  'length' => $this->limit,
  'search' =>$this->formatSearch(), 
  '_' => '1430226949951',
);
    return (http_build_query($data));
}



    public function limitedTo($argument1)
    {
        $this->limit = $argument1;
        return $this;
    }

    public function startingFrom($argument1)
    {
        $this->start = $argument1;
        return $this;
    }

    public function searchFor($search_term)
    {
        $this->search_term = $search_term;
        return $this;
    }

    public function addSorter($argument1, $argument2)
    {
        $this->sorting[] = new Sorter($argument1, $argument2);
        return $this;
    }
}
