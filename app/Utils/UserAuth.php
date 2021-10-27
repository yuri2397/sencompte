<?php
namespace App\Utils;
use App\Models\User;

trait UserAuth{

    public function isAdmin($u)
    {
        $user = User::whereEmail($u->email)->first();
        if ($user){
            return true;
        }

        return false;
    }
}
