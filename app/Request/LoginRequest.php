<?php 

namespace Sliminitial\Request;

use Respect\Validation\Validator as validator;

class LoginRequest
{
    public static function rules()
    {
        return [
            'email' => validator::noWhitespace()->notEmpty()->email(),
            'password' => validator::noWhitespace()->notEmpty()
        ];
    }
}