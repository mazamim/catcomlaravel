<?php

namespace App;
use App\MyProject;

use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = 'job_types';
    protected $fillable = ['jobType'];



    function myProject()
    {
        return $this->hasMany(MyProject::class);

    }
}
