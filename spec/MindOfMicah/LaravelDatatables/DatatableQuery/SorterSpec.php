<?php

namespace spec\MindOfMicah\LaravelDatatables\DatatableQuery;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SorterSpec extends ObjectBehavior
{
    public function let()
    {
        $this->BeConstructedWith(0, 'ASC');
    }


    public function it_can_be_flattened_into_an_array()
    {
        $this->toArray()->shouldBe(['col' => 0, 'dir' => 'asc']);
    }
}
