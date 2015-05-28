<?php
namespace MindOfMicah\LaravelDatatables;

use Illuminate\Support\ServiceProvider;

class DatatableProvider extends ServiceProvider
{
    public function boot()
    {
        $this->package('mindofmicah/laravel-datatables', 'datatables');
    }
	public function register()
	{
		\App::bind('MindOfMicah\LaravelDatatables\Datatable', function () {
			return new \MindOfMicah\LaravelDatatables\Datatable;
		});
		
		\App::bind('mindofmicah.datatables', function () {
			return new \MindOfMicah\LaravelDatatables\Datatable;
		});
	}
}
