<?php
namespace MindOfMicah\LaravelDatatables;

use Illuminate\Http\JsonResponse;
use MyProject\Proxies\__CG__\stdClass;

class Datatable
{
    protected $model;
    private $route;
    protected $selector;
    protected $columns=[];

    private $data = [
        'data' => null,
        'processing' => true,
        'displayLength' => 250,
        'language' => [
            'emptyTable' => 'Loading in results',
            'infoEmpty' => 'Loading in results'
        ],
        'lengthMenu' => [[100, 250, 500, -1], [100, 250, 500, "All"]]

    ];

    public function __construct()
    {
        $this->a = null;
        $this->selector = $this->generateSelector();
    }

    public function __toString()
    {
        return (string)(\View::make('datatables::script', ['datatable' => $this]));
        die();
        dd('asdf', $d);
    }

    public function magic()
    {
        return $this;
    }

    public function data(array $data = null)
    {
        if (!$data) {
            return $this->data;
        }

        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function selector()
    {
        return $this->selector;
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
            'aaData' => $data,
            'iTotalRecords' => $total,
            'iTotalDisplayRecords' => $amount_displayed
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

    public function route($route = null)
    {
        if ($route) {
            $this->route = $route;
            return $this;
        }
        return $this->route;
    }

    public function columns()
    {
        $this->columns = func_get_args();
        $this->data['columns'] = $this->columnsAsJSON();
        return $this;
    }

    public function columnsAsJSON()
    {
        return (array_map(function ($column) {
            $obj = new \stdClass();
            $obj->title = $column;
            return $obj;
        }, $this->columns));
    }

    private function generateSelector()
    {
        return uniqid('dt-');
    }
}
