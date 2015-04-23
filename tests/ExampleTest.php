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
        TestDummy::create('Model', ['hi'=>'micah']);                

        $response = $this->visit('/apples.php?model=Model')
            ->seeJSONContains(['hi'=>'micah']);
	}
}
