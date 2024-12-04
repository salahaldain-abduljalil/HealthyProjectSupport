<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getAllArticles(){

        return view('Backend.allarticles');
    }
    public function CreateArticle(){

        return view('Backend.createarticles');
    }
}
