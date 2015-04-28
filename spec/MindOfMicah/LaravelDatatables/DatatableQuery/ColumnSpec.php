<?php

namespace spec\MindOfMicah\LaravelDatatables\DatatableQuery;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ColumnSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\LaravelDatatables\DatatableQuery\Column');
    }

    public function it_can_be_flattened_into_an_array()
    {
        $this->data = 1;
        $this->name = 'name';
        $this->searchable = 'true';
        $this->orderable = 'true';
        $this->search = [
            'value'=>'',
            'regex'=>'false'
        ];

        $this->toArray()->shouldBe([
            'data'=>1,
            'name'=>'name',
            'searchable'=>'true',
            'orderable'=>'true',
            'search'=>[
                'value'=>'',
                'regex'=>'false'
            ]
        ]);
    }
}
