<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function project()
    {
        return $this->belongsTo('\App\Models\Project'); //Each of these employee belongs To one of the project//
    }

}
