<?php
return [
    'all' => function (&$datatable) {
        $datatable->forEloquentModel('\\Model'); 
    },
    'columns' => function (&$datatable) {
        $datatable->forEloquentModel('\\Model')
            ->pluckColumns('hi'); 
    },
    'limit'=> function (&$datatable) {
        $datatable->forEloquentModel('\\Model');
    },
    'search'=> function (&$datatable) {
        $datatable->forEloquentModel('\\Model')->pluckColumns('hi');
    }

];
