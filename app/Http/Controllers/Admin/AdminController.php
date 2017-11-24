<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit ()
    {
        $user = User::where('id', auth()->user()->id)
            ->first();

        return view('admin.edit')->with(compact('user'));
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
                'visiteur' => false,
                'admin' => true
            ]);
        } else {
            $user = User::where('id', auth()->user()->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'visiteur' => false,
                'admin' => true
            ]);
        }

        if ($user) {
            flash(__("Profil sauvegardé avec succès !"))->success();
        } else {
            flash(__("Une erreur s'est produite."))->error();
        }

        return redirect()->route('admin:profil:edit');
    }

    public function manage(Request $request)
    {
        $users = User::where('admin', false)
            ->get();

        return view('admin.manage')
            ->with(compact('users'));
    }

    public function manageStore(Request $request, int $userId)
    {
        if($request->has('visiteur') && $request->has('admin'))
        {
            return redirect()->route('admin:manage');
        }

        $user = User::where('id', $userId)->update([
            'visiteur' => $request->has('visiteur'),
            'admin' => $request->has('admin')
        ]);

        return redirect()->route('admin:manage');
    }
}
