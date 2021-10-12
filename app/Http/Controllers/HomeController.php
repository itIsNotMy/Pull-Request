<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class HomeController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
       return redirect(route('articles.index'));
    }
}
