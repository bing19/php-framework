<?php

namespace App\Controllers;

use Core\Framework\Http\Request;

class Controller 
{
    public function __construct(
        protected Request $request)
        {}
}