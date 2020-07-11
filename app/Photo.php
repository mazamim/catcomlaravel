<?php

namespace App;
use App\Employee;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = ['url','emp_id'];

    public function employee(){

        return $this->belongsTo(Employee::class);
        }
}
