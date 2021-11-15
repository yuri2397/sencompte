<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayementNotConf extends Model
{
    use HasFactory;

    protected $fillable = ["*"];

    protected $table = "payement_not_confs";
}
