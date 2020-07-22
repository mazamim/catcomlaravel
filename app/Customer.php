<?php

namespace App;
use App\MyProject;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    
    protected $table = 'customers';
    protected $fillable = ['cus_name','mobile'];

    function myProject()
    {
        return $this->hasMany(MyProject::class);

    }
}
