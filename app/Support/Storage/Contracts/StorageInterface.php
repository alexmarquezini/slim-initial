<?php 

namespace SlimInitial\Support\Storage\Contracts;

interface StorageInterface
{
    public function get($path);
    public function set($path, $contents);
    public function delete($path);
    public function exists($path);
    public function clear();
    public function all();

}