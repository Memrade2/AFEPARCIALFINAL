<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public function subsidiary(){
        return $this->belongsTo(Subsidiary::class);
    }
    public function administrator(){
        return $this->belongsTo(Administrator::class);
    }
}
