<?php 

namespace SlimInitial\Handlers;

use SlimInitial\Handlers\Contracts\HandlerInterface;

class SendWelcomeMail implements HandlerInterface
{
    public function handler($event)
    {
        var_dump('Send welcome mail to ' . $event->user->email);
    }
}