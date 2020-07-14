<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['emp_name','lastname' , 'position', 'mobile','emailadd','description'];

    function mypics()
    {
        return $this->hasMany(Photo::class);

    }

    function myattendance()
    {
        return $this->hasMany(Attendance::class);

    }
}

