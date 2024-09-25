<?php 

namespace SlimInitial\Support\Validation\Contracts;

use Psr\Http\Message\ServerRequestInterface;

interface ValidatorInterface
{
    public function validate(ServerRequestInterface $data, array $rules);
    public function failed();

}