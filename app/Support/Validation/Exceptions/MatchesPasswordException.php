<?php 

namespace SlimInitial\Support\Validation\Exceptions;
use Respect\Validation\Exceptions\ValidationException;

class MatchesPasswordException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'A senha informada está incorreta.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'A senha informada está correta.',
        ]
    ];
}