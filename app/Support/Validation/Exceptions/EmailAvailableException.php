<?php 

namespace SlimInitial\Support\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class EmailAvailableException extends ValidationException
{
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'O e-mail já está em uso.',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'O e-mail não está disponível.',
        ]
    ];
}