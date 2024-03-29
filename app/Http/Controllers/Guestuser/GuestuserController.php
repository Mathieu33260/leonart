<?php

namespace App\Http\Controllers\Guestuser;

use App\User;
use App\Models\Oeuvre;
use App\Models\VisitedOeuvre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class GuestuserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit ()
    {
        $user = User::where('id', auth()->user()->id)
            ->first();

        return view('guestuser.edit')->with(compact('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save (Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|max:255|email',
            'password' => 'nullable|string|min:6|max:255|confirmed'
        ]);

        if ( !$request->input('password') == '')
        {
            $user = User::where('id', auth()->user()->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'visiteur' => true,
                'admin' => false
            ]);
        } else {
            $user = User::where('id', auth()->user()->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'visiteur' => true,
                'admin' => false
            ]);
        }

        if ($user) {
            flash(__("Profil sauvegardé avec succès !"))->success();
        } else {
            flash(__("Une erreur s'est produite."))->error();
        }

        return redirect()->route('guestuser:profil:edit');
    }

    public function index()
    {
        $oeuvres = Oeuvre::all();

        $map = View::make('map.mapvisiteur')
            ->with(compact('oeuvres'))
            ->render();

        $oeuvreV = VisitedOeuvre::all();

        return view('guestuser.home')
            ->with(compact('map'))
            ->with(compact('oeuvreV'));
    }

}
