<?php

namespace Core\Controllers;

use Core\Models\User as User;

class UserController
{
    function __construct($req, $res){
        $res->render('signup', array(
                'title' => 'Sign up',
                'auth' => [
                    "signup" => $req->path
                ]
            )
        );        
    }

}
