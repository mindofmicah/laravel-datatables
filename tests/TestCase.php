<?php
use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;

class TestCase extends IntegrationTest
{
    protected function response() 
    {
        return (string)$this->client->getResponse()->getContent();
    }
}
