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
        foreach ($this->sanitizeTablesUsed() as $table) {
            $this->capsule->table((string)$table)->truncate();
        }
    }

    protected function sanitizeTablesUsed() 
    {
        if (empty($this->tables_used)) {
            return []; 
        }    
        if (!is_array($this->tables_used)) {
            return [$this->tables_used];
        }

        return [];
    }
}
