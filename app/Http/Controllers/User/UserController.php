<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit ()
    {
        $user = User::where('id', auth()->user()->id)
            ->first();

        return view('user.edit')->with(compact('user'));
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

        /*$user = User::where('id', auth()->user()->id)
            ->first();

        $user->username = $request->input('name');
        $user->email = $request->input('email');

        $user->update(
            ($request->has('password') ? array_merge($request->except('password'), ['password' => bcrypt($request->input('password'))])
                : $request->except('password'))
        );*/

        if ( !$request->input('password') == '')
        {
            //$user->password = bcrypt($request->input('password'));
            $user = User::where('id', auth()->user()->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ]);
        } else {
            $user = User::where('id', auth()->user()->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ]);
        }

        //$user->save();

        if ($user) {
            flash(__("Profil sauvegardé avec succès !"))->success();
        } else {
            flash(__("Une erreur s'est produite."))->error();
        }

        return redirect()->route('user:profil:edit');
    }
}
