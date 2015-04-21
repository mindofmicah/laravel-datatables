<?php
class ExampleTest extends TestCase 
{
    use EloquentFunctionalityTrait;

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
