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
            $message->to('mat_dumez@hotmail.fr')->subject('Contact');
        });

        return view('contact.confirmContact');
    }

    public function mentions()
    { 
    	return view("pages.mentions");
    }
}
