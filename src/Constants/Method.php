<?php

namespace App\Constants;

class Method
{
    public const GET = "GET";
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const DELETE = 'DELETE';
    private function __construct()
    {
        // Prevent instantiation
    }

    public static function getAllMethod() : array
    {
        return array(self::GET, self::POST, self::PUT, self::DELETE);
    }
}
