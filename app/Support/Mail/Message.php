<?php 

namespace SlimInitial\Support\Mail;

use SlimInitial\Support\Mail\Contracts\MailInterface;

class Message
{

    protected $mailer;

    public function __construct(MailInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function to($address, $name = '')
    {
        $this->mailer->to($address, $name);
        return $this;
    }

    public function from($address, $name = '')
    {
        $this->mailer->from($address, $name);
        return $this;
    }

    public function subject($subject)
    {
        $this->mailer->subject($subject);
        return $this;
    }

    public function body($body)
    {
        $this->mailer->body($body);
        return $this;
    }

}