<?php
namespace MindOfMicah\LaravelDatatables;
use Illuminate\Support\Facades\Facade;

class DatatableFacade extends Facade
{
	protected static function getFacadeAccessor()
    {
        return 'mindofmicah.datatables';
    }
}
