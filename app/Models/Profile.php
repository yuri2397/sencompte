<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['*'];

    protected $with = ['account', 'client'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }


}
