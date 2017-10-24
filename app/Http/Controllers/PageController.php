<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 20/10/2017
 * Time: 09:28
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function index ()
    {
        return view('pages.index');
    }

    public function show ($page) {
        return view("pages.$page");
    }
}