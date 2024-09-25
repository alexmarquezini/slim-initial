<?php 

namespace SlimInitial\Support\Mail\Decorator;

use SlimInitial\Support\Mail\Contracts\MailInterface;

class SwiftDecorator implements MailInterface
{
    protected $swift;

    public function __construct($swift, $config = [])
    {
        $this->swift = $swift;
    }

    public function to($address, $name = '')
    {
        $this->swift->setTo($address, $name);
        return $this;
    }

    public function from($address, $name = '')
    {
        $this->swift->setFrom($address, $name);
        return $this;
    }

    public function subject($subject)
    {
        $this->swift->setSubject($subject);
        return $this;
    }

    public function body($body)
    {
        $this->swift->setBody($body);
        return $this;
    }

    public function send()
    {
        $this->swift->send();
    }
}