<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\Eloquent\Builder;

class LeavesCarryOverLimit extends Model
{
    protected $table = 'leaves_carry_type';
}