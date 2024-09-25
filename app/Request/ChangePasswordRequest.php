<?php 

namespace SlimInitial\Request;

use Respect\Validation\Validator as validator;
class ChangePasswordRequest
{
    public static function rules()
    {
        return [
            'password_old' => validator::noWhitespace()->notEmpty()->matchesPassword(),
            'password' => validator::noWhitespace()->notEmpty(),
            'password_confirm' => validator::noWhitespace()->notEmpty()->equals($_POST['password'])
        ];
    }
}

