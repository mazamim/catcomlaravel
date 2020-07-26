<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyProject extends Model
{
    protected $table = 'my_projects';
    protected $fillable = ['address','jobType','describtion','status','cus_id','client_id'];
}
