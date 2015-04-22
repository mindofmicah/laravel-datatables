<?php
use Laracasts\Integrated\Extensions\Goutte as IntegrationTest;

use Illuminate\Database\Capsule\Manager as Capsule;

trait EloquentFunctionalityTrait 
{
    protected $tables_used = [];

    /**
     * Begin a new database transaction.
     *
     * @setUp
     */
    public function beginTransaction()
    {
        $this->capsule = buildCapsuleFromConfigFile(__DIR__ . '/../integrated.json');
        $this->clearTables();
    }

    /**
     * Rollback the transaction.
     *
     * @tearDown
     */
    public function rollbackTransaction()
    {
        $this->clearTables();
    }

    protected function clearTables()
    {
        if (!is_array($this->tables_used)) {
            $this->tables_used = [$this->tables_used];
        }

        foreach ($this->tables_used as $table) {
            $this->capsule->table($table)->truncate();
        }
    }
}
