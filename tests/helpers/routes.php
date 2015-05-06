<?php
return [
    'all' => function (&$datatable) {
        $datatable->forEloquentModel('\\Model'); 
    },
    'columns' => function (&$datatable) {
        $datatable->forEloquentModel('\\Person')
            ->pluckColumns('first', 'last'); 
    },
    'limit'=> function (&$datatable) {
        $datatable->forEloquentModel('\\Model');
    },
    'search'=> function (&$datatable) {
        $datatable->forEloquentModel('\\Model')
            ->pluckColumns('hi');
    },
    'search-many'=> function (&$datatable) {
        $datatable->forEloquentModel('\\Person')
            ->pluckColumns('first', 'last');
    }

];
