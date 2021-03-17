<?php
namespace App\Helpers;
use App\Services\Likeable;

class Service
{
    public function __construct(string $likeable)
    {
        $this->likeable = $likeable;
    }

    public function name($full = false): string
    {
        $called = explode("\\", $this->likeable);
        if($full) {
            return "\\App\\Services\\" . end($called);
        }
        return end($called);
    }

    public function likeable(): Likeable
    {
        return new ($this->name(true))();
    }
}