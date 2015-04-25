<?php
namespace MindOfMicah\LaravelDatatables;

use Illuminate\Support\ServiceProvider;

class DatatableProvider extends ServiceProvider
{
	public function register()
	{
		\App::bind('MindOfMicah\LaravelDatatables\Datatable', function ($a) {
			return new \MindOfMicah\LaravelDatatables\Datatable($a->make('request'));
		});
		
		\App::bind('mindofmicah.datatables', function ($a) {
			return new \MindOfMicah\LaravelDatatables\Datatable($a->make('request'));
		});
	}
}