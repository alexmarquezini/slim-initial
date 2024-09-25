<?php 

namespace SlimInitial\Handlers;
use SlimInitial\Events\Event;


class UserWasCreated extends Event
{
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

}