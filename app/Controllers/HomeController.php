<?php

namespace App\Controllers;

use Core\Framework\Http\Response;
use Core\Framework\Http\Request;
use App\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $content = '<h1> HOME CONTROLLER</h1>';
        return new Response($content);
    }

    public function store(){
        $data = $this->request->getPostData();
        return new Response(implode(', ', $data));
    }
}