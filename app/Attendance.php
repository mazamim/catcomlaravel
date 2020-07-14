<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = ['emp_id','tDate','punchIn','punchOut'];

    public function employee(){

        return $this->belongsTo(Employee::class);
        }
}
