<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverlapLog extends Model
{
    protected $fillable = ['input_a','input_b','sensitive','result_pct'];
}
