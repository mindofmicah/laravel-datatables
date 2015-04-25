<?php
use Laracasts\TestDummy\Factory as TestDummy;
use Laracasts\Integrated\Extensions\ApiRequests;

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

    protected function visitDatatable($key)
    {
        $url = 'sEcho=2&iColumns=5&sColumns=&iDisplayStart=0&iDisplayLength=-1&mDataProp_0=partNumber&mDataProp_1=stock&mDataProp_2=backorder_qty&mDataProp_3=on_order&mDataProp_4=function&sSearch=&bRegex=false&sSearch_0=&bRegex_0=false&bSearchable_0=true&sSearch_1=&bRegex_1=false&bSearchable_1=true&sSearch_2=&bRegex_2=false&bSearchable_2=true&sSearch_3=&bRegex_3=false&bSearchable_3=true&sSearch_4=&bRegex_4=false&bSearchable_4=false&iSortCol_0=1&sSortDir_0=desc&iSortingCols=1&bSortable_0=true&bSortable_1=true&bSortable_2=true&bSortable_3=true&bSortable_4=false&_=1429910529659';
        return $this->visit('/router.php?action=' . $key . '&' . $url);
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
