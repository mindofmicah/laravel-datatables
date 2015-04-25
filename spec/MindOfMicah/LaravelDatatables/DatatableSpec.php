<?php

namespace spec\MindOfMicah\LaravelDatatables;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DatatableSpec extends ObjectBehavior
{
    
    public function it_returns_a_jsonresponse()
    {
        $this->asJsonResponse()->shouldHaveType('Illuminate\Http\JsonResponse');
    }

    public function it_lets_an_eloquent_model_be_an_entry_point()
    {
        $this->forEloquentModel('Model')->shouldBe($this);
    }
    public function it_lets_us_define_which_columns_will_be_plucked()
    {
        $this->pluckColumns('column')->shouldBe($this);
    }
}
