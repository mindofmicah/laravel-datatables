<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;

class TestCase extends IntegrationTest 
{
    public function __construct()
    {
        $this->capsule = buildCapsuleFromConfigFile(__DIR__ . '/../integrated.json');
    }
}
