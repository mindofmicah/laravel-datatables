<?php
use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;

use Illuminate\Database\Capsule\Manager as Capsule;

trait EloquentFunctionalityTrait 
{
    /**
     * Begin a new database transaction.
     *
     * @setUp
     */
    public function beginTransaction()
    {
        $this->capsule->table('m')->truncate();
    }

    /**
     * Rollback the transaction.
     *
     * @tearDown
     */
    public function rollbackTransaction()
    {
        $this->capsule->table('m')->truncate();
    }
}
