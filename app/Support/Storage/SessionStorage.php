<?php 

namespace SlimInitial\Support\Storage;

use Countable;
use SlimInitial\Support\Storage\Contracts\StorageInterface;

class SessionStorage implements StorageInterface, Countable
{
    protected $bucket;

    public function __construct($bucket = 'default')
    {
        if(!isset($_SESSION[$bucket])) {
            $_SESSION[$bucket] = [];
        }
        $this->bucket = $bucket;
    }

    public function get($key)
    {
        if(!$this->exists($key)) {
            return null;
        }
        return $_SESSION[$this->bucket][$key];
    }

    public function set($key, $contents)
    {
        $_SESSION[$this->bucket][$key] = $contents;
    }

    public function delete($key)
    {
        if($this->exists($key)) {
            unset($_SESSION[$this->bucket][$key]);
        }
    }

    public function exists($key)
    {
        return isset($_SESSION[$this->bucket][$key]);
    }

    public function clear()
    {
        unset($_SESSION[$this->bucket]);
    }

    public function all()
    {
        return $_SESSION[$this->bucket];
    }

    public function count()
    {
        return count($this->all());
    }

}