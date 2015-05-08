<?php
namespace MindOfMicah\LaravelDatatables;

use Illuminate\Http\JsonResponse;

class Datatable
{
    protected $model;
    protected $columns=[];

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

            $search_info = $this->a->input('search');
            if (!empty($search_info['value'])) {
                foreach ($this->a->input('columns') as $index => $column) {
                    if ($index) {
                        $sql->orWhere($column['name'], 'LIKE', '%' . $search_info['value'] . '%');
                    } else {
                        $sql->where($column['name'], 'LIKE', '%' . $search_info['value'] . '%');
                    }
                }
            }

            
            foreach ($this->a->input('order', []) as $order) {
                $sql->orderBy($this->a->input('columns')[$order['col']]['name'], $order['dir']);
            }
            \Illuminate\Database\Capsule\Manager::enableQueryLog();
            $total = ($sql->count());
            $sql->skip($this->a->input('start'));
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

    public function pluckColumns()
    {
        $this->columns = array_merge($this->columns, func_get_args());
        return $this;
    }
}
