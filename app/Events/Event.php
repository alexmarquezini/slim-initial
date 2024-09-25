<?php 

namespace SlimInitial\Events;

use SlimInitial\Handlers\Contracts\HandlerInterface;

class Event
{
    protected $handlers = [];

    public function attach($handler)
    {
        if(is_array($handler)) {
            foreach($handler as $singleHandler) {
                $this->handlers[] = $singleHandler;
            }
        } else {
            $this->handlers[] = $handler;
        }
    }

    public function dispatch()
    {
        foreach($this->handlers as $handler) {
            if($handler instanceof HandlerInterface) {
                $handler->handler($this);
            }
        }
    }
}