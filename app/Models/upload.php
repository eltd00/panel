<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class upload extends Model
{
    use HasFactory;
    protected $table = "uploads";
    protected $fillable = ["id", "employee_id", "photo","extension"];
    public $timestamps = false;
    public function employee(){
        return $this->belongsTo('App\Models\Employee','employee_id');
    }
}
