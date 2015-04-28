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
            'aaData'=>[
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

}
