<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quesionnairs extends Model
{
    protected $guarded = [];

    public function choice()
    {

        return $this->hasMany(Choice::class);
    }
}
