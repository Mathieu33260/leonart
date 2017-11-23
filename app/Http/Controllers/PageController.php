<?php
/**
 * Created by PhpStorm.
 * User: Quentin
 * Date: 20/10/2017
 * Time: 09:28
 */

namespace App\Http\Controllers;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;




class PageController extends Controller
{
    public function index ()
    {
        return view('pages.index');
    }

    public function show ($page) {
        return view("pages.$page");
    }

    public function contact()
    {
        return view("contact.contact");
    }

    public function contactPost(ContactRequest $request)
    {
        Mail::send('contact.email_contact', $request->all(), function($message)
        {
            $message->to('leonartfr@gmail.com')->subject('Contact'); //This is subject to change since we still don't have any access to @leon-art.fr domain.
        });

        return view('contact.confirmContact');
    }

    public function mentions()
    {
    	return view("pages.mentions");
    }

    public function map()
    {
      $oeuvres = DB::table('oeuvre')->get();

      $map = View::make('map.mapvisiteur')
          ->with(compact('oeuvres'))
          ->render();

      return view('pages.map')->with(compact('map'));

    }
}
