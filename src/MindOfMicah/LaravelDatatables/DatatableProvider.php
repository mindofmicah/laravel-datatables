<?php
namespace MindOfMicah\LaravelDatatables;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class DatatableProvider extends ServiceProvider
{
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
