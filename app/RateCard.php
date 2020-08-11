<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateCard extends Model
{
    protected $table = 'rate_cards';
    protected $fillable = ['sor','description','uom','rate','category','client_id'];
}
