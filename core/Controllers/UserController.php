<?php

namespace Core\Controllers;

use Core\Models\User as User;

class UserController
{
    public function getSignUp($req, $res){
        return $res->render('signup', array(
                'title' => 'Sign up',
                'auth' => [
                    "signup" => $req->path
                ]
            )
        );        
    }
}
