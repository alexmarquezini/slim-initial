<?php 

namespace SlimInitial\Support\Mail;

use Slim\Views\Twig;
use SlimInitial\Support\Mail\Contracts\MailInterface;

class Mailer 
{
    protected $mailer;

    protected $view;

    public function __construct(MailInterface $mailer, Twig $view)
    {
        $this->mailer = $mailer;
        $this->view = $view;
    }

    public function send($template, $data, $callback)
    {
        $message = new Message($this->mailer);
        $template = $this->view->fetch($template, $data);
        $message->body($template);
        call_user_func($callback, $message);
        $this->mailer->send();
    }
}