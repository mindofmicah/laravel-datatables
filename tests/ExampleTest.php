<?php
use Laracasts\TestDummy\Factory as TestDummy;
use Laracasts\Integrated\Extensions\Traits\ApiRequests;

use MindOfMicah\LaravelDatatables\DatatableQuery\Datatable;
use MindOfMicah\LaravelDatatables\DatatableQuery\Column;

class ExampleTest extends TestCase
{
    use EloquentFunctionalityTrait;
    use ApiRequests;

    protected $tables_used = ['m'];
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
        $a = [
            'aaData' =>[
            ],

            'iTotalRecords'=>0,
            'iTotalDisplayRecords'=>0
        ];
        $response = $this->visitDatatable('empty')
            ->seeJSONContains(($a));
	}

    protected function visitDatatable($key, $dt = null)
    {
        if (!$dt) {
            $dt = new Datatable;
            $dt->addDummyColumns(4);
        }

        return $this->visit('/router.php?action=' . $key . '&' . (string)$dt);
    }
    public function testSelectAllForAGivenModel()
    {
        $data = [
            TestDummy::create('Model')->toArray(), 
            TestDummy::create('Model')->toArray()
        ];        

        $this->visitDatatable('one');
        $a = [
            'aaData'=> $data,
            'iTotalRecords'=>2,
            'iTotalDisplayRecords'=>2
        ];
        $this->visitDatatable('all')->seeJSONContains($a);
    }
    public function testSelectAllForWithPluckedColumns()
    {
        $data = [
            TestDummy::create('Model', ['hi'=>'micah'])->toArray(), 
            TestDummy::create('Model', ['hi'=>'sam'])->toArray()
        ];        

        $this->visitDatatable('one');
        $a = [
            'aaData'=> [
                ['hi'=>'micah'],
                ['hi'=>'sam'],
            ],
            'iTotalRecords'=>2,
            'iTotalDisplayRecords'=>2
        ];
        $this->visitDatatable('columns')->seeJSONContains($a);
    }

    public function testDatatableRespectsASetLimit()
    {
        $expected = [TestDummy::create('Model')->toArray()];
        TestDummy::times(50)->create('Model');
        $a = [
            'aaData'=> $expected,
            'iTotalRecords'=>51,
            'iTotalDisplayRecords'=>1
        ];
        $dt = new Datatable;
        $dt->limitedTo(1);
        $this->visitDatatable('limit', $dt)->seeJSONContains($a);
    }
    public function testDatatableLetsYouPaginate()
    {
        TestDummy::times(50)->create('Model');
        $expected = [TestDummy::create('Model')->toArray()];
        $a = [
            'aaData'=> $expected,
            'iTotalRecords'=>51,
            'iTotalDisplayRecords'=>1
        ];
        $dt = new Datatable;
        $dt->limitedTo(1);
        $dt->startingFrom(50);
        $this->visitDatatable('limit', $dt)->seeJSONContains($a);

    }

    public function testWeCanSearchByAColumn()
    {
        TestDummy::create('Model',['hi'=>'micah smith']);//->toArray(),
        TestDummy::create('Model',['hi'=>'micah escobar']);
        $expected = [
            ['hi'=>'micah smith'],
            ['hi'=>'micah escobar']
        ];
        TestDummy::create('Model');
        $a = [
            'aaData'=> $expected,
            'iTotalRecords'=>2,
            'iTotalDisplayRecords'=>2
        ];
        $dt = new Datatable;
        $dt->searchFor('micah');
        $dt->addNamedColumns('hi');
        $this->visitDatatable('search', $dt)->seeJSONContains($a);

    }
}
