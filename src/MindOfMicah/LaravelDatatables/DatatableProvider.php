<?php
namespace MindOfMicah\LaravelDatatables;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;

class DatatableProvider extends ServiceProvider
{
    public function boot()
    {
//        $this->package('mindofmicah/laravel-datatables');
        $this->package('mindofmicah/laravel-datatables', 'datatables');
//        \View::addNamespace('datatables', __DIR__. '/../../views');
    }
	public function register()
	{
		\App::bind('MindOfMicah\LaravelDatatables\Datatable', function (Application $a) {
			return new \MindOfMicah\LaravelDatatables\Datatable($a->make('request'));
		});
		
		\App::bind('mindofmicah.datatables', function (Application $a) {
			return new \MindOfMicah\LaravelDatatables\Datatable($a->make('request'));
		});
	}
}
