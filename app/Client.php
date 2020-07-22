<?php

namespace App;
use App\MyProject;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    protected $fillable = ['client_name','mobile'];

    function myProject()
    {
        return $this->hasMany(MyProject::class);

    }
}
