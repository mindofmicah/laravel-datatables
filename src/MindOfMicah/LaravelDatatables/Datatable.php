<?php
namespace MindOfMicah\LaravelDatatables;

use Illuminate\Http\JsonResponse;

class Datatable
{
    protected $model;
    protected $columns;
    public function asJsonResponse()
    {
        $data = [];
        $total = $amount_displayed = 0;
        if ($this->model) {
            $model_name = $this->model;
            if ($this->columns) {

            }
            $models = $model_name::select($this->columns?:'*')->get();
            $data = $models->toArray();
            $total = count($models);
            $amount_displayed = count($models);
        }
       // return new JsonResponse([], 200);
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
        // TODO: write logic here
        return $this;
    }
}
