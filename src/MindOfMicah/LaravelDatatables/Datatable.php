<?php
namespace MindOfMicah\LaravelDatatables;

use Illuminate\Http\JsonResponse;

class Datatable
{
    protected $model;
    protected $columns;

	public function __construct($a) {
        $this->a = $a;
	}
	
    public function asJsonResponse()
    {
        $data = [];
        $total = $amount_displayed = 0;
        if ($this->model) {
            $model_name = $this->model;
            if ($this->columns) {

            }
            $sql = $model_name::query()->select($this->columns ?: '*');

            $total = ($sql->count());
            $models = $sql->take($this->a->input('length'))->get();
            $data = $models->toArray();
            
            $total = $total;
            $amount_displayed = count($models);
        }

        $data = ([
            'aaData'=>$data,
            'iTotalRecords'=>$total,
            'iTotalDisplayRecords'=>$amount_displayed
        ]);
        return new JsonResponse($data, 200);
    }

    public function forEloquentModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function pluckColumns($argument1)
    {
        $this->columns[] = $argument1;
        return $this;
    }
}
