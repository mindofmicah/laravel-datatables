<?php
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    protected $table = 'm';
    protected $fillable = ['hi'];
}
