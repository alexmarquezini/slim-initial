<?php 

namespace SlimInitial\Support\Validation;
use Respect\Validation\Rules\AbstractRule;
use SlimInitial\Models\User;

class EmailAvailable extends AbstractRule
{
    public function validate($input)
    {
        return User::where('email', $input)->count() === 0;
    }
}