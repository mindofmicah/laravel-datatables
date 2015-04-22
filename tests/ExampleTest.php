<?php
use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;

class ExampleTest extends IntegrationTest 
{
    use EloquentFunctionalityTrait;

    protected $tables_used = ['m'];
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
        $this->visit('/apples.php')->andSeeInDatabase('m', ['hi'=>'b']);
	}
}
