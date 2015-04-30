<?php

namespace spec\MindOfMicah\LaravelDatatables\DatatableQuery;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DatatableSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('MindOfMicah\LaravelDatatables\DatatableQuery\Datatable');
    }
    public function it_can_add_dummy_columns()
    {
        $this->addDummyColumns(2)->shouldBe($this);;
        $this->columns->shouldHaveCount(2);
        $this->columns[0]->data->shouldBe(0);
        $this->columns[1]->data->shouldBe(1);
    }

    public function it_can_add_named_columns()
    {
        $this->addNamedColumns('mycolumn', 'secondcolumn')->shouldBe($this);;
        $this->columns->shouldHaveCount(2);
        $this->columns[0]->name->shouldBe('mycolumn');
        $this->columns[1]->name->shouldBe('secondcolumn');
    }
    public function it_allows_a_limit_to_be_set()
    {
        $this->limitedTo(5)->shouldBe($this);
    }

}
