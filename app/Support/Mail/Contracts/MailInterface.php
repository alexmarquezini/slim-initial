<?php 

namespace SlimInitial\Support\Mail\Contracts;

interface MailInterface
{
    public function to($address, $name = '');
    public function from($address, $name = '');
    public function subject($subject);
    public function body($body);
    public function send();
}