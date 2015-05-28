<?php
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Person extends EloquentModel
{
    protected $table = 'people';
    protected $fillable = ['first','last'];
}
