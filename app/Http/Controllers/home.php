<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Redirect;

class home extends BaseController
{

    function test()
    {
	return view('welcome');
    }

    function index()
    {
        if (Auth::check())
        {
            $article_data = articleController::get('articles.id', '<>', 0);
            return view('index')
                ->with('articleData', $article_data);
        } else {
            return Redirect::to('/login');
        }
    }

    function recent()
    {
        if (Auth::check())
        {
            $article_data = articleController::get('articles.uid', '=', Auth::user()->id);
	    $len = count($article_data);
	    for($i=5; $i<$len; $i++) unset($article_data[$i]);
            return view('index')
                ->with('articleData', $article_data);
        } else {
            return Redirect::to('/login');
        }
    }

    function article($id)
    {
        if (Auth::check())
        {
            $article_data = articleController::get('articles.id', '=', $id);
            return view('/article')
                ->with('articleData', $article_data);
        } else {
            return Redirect::to('/');
        }
    }

    function login($status = null)
    {
        return view('auth/login')->with('status', $status);
    }

    function register($status = null)
    {
        return view('auth/register')->with('status', $status);
    }

    function canvas()
    {
	return view('canvas');
    }
}
