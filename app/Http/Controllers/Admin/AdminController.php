<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
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
            ->limit(9)
            ->get();

        return view('admin.manage')
            ->with(compact('users'));
    }

    public function manageAjax($offset,$string = "")
    {
        if($string != "")
        {
            $users = User::where('name', 'like', '%'.$string.'%')
                ->where('admin', false)
                ->orderBy('id','ASC')
                ->offset($offset)
                ->limit(9)
                ->get();
        } else {
            $users = User::where('admin', false)
                ->orderBy('id','ASC')
                ->offset($offset)
                ->limit(9)
                ->get();
        }

        return $users->toArray();
    }

    public function manageStore(Request $request, int $userId)
    {
        $user = User::where('id', $userId)
            ->first();

        $visiteur = true;
        $admin = false;

        if(!$user->visiteur && !$user->admin)
        {
            $visiteur = true;
            $admin = false;
        }
        if($user->visiteur && !$user->admin)
        {
            $visiteur = false;
            $admin = false;

            $type = Type::where('userId', $userId)
                ->get();

            if(!count($type))
            {
                $type1 = Type::create([
                    'libelle' => 'Monument',
                    'userId' => $user->id
                ]);

                $type2 = Type::create([
                    'libelle' => 'Sculpture',
                    'userId' => $user->id
                ]);

                $type3 = Type::create([
                    'libelle' => 'Peinture',
                    'userId' => $user->id
                ]);
            }
        }
        if($user->admin)
        {
            return redirect()->route('admin:manage');
        }

        $user->update([
            'visiteur' => $visiteur,
            'admin' => $admin
        ]);

        return redirect()->route('admin:manage');
    }
}
