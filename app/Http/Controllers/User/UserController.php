<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Artiste;
use App\Models\Oeuvre;
use App\Models\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

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

        if ( !$request->input('password') == '')
        {
            $user = User::where('id', auth()->user()->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'visiteur' => false,
                'admin' => false
            ]);
        } else {
            $user = User::where('id', auth()->user()->id)->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'visiteur' => false,
                'admin' => false
            ]);
        }

        if ($user) {
            flash(__("Profil sauvegardé avec succès !"))->success();
        } else {
            flash(__("Une erreur s'est produite."))->error();
        }

        return redirect()->route('user:profil:edit');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oeuvres = Oeuvre::where('userId', auth()->user()->id)
            ->get();
        $type = Type::where('userId', auth()->user()->id)
            ->get();
        $artiste = Artiste::where('userId', auth()->user()->id)
            ->get();
        $oeuvresLast = Oeuvre::where('userId', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $oeuvreOrdType = DB::table('oeuvre')
            ->join('type', 'oeuvre.typeId', '=', 'type.id')
            ->where('oeuvre.userId', auth()->user()->id)
            ->where('type.userId', auth()->user()->id)
            ->select('type.libelle', DB::raw('count(*) as total'))
            ->groupBy('libelle')
            ->get()
            ->toArray();

        $tab1 = array();
        $tab2 = array();
        foreach($oeuvreOrdType as $oeuvree)
        {
            array_push($tab1,$oeuvree->libelle);
            array_push($tab2,$oeuvree->total);
        }

        $oeuvreOrdArtiste = DB::table('oeuvre')
            ->join('artiste', 'oeuvre.artisteId', '=', 'artiste.id')
            ->where('oeuvre.userId', auth()->user()->id)
            ->where('artiste.userId', auth()->user()->id)
            ->select('artiste.nom', DB::raw('count(*) as total'))
            ->groupBy('nom')
            ->get()
            ->toArray();

        $tab3 = array();
        $tab4 = array();
        foreach($oeuvreOrdArtiste as $oeuvree)
        {
            array_push($tab3,$oeuvree->nom);
            array_push($tab4,$oeuvree->total);
        }

        $general = View::make('charts.general')
            ->with(compact('type'))
            ->with(compact('artiste'))
            ->with(compact('oeuvres'))->render();

        $oeuvreT = View::make('charts.oeuvreType')
            ->with(compact('tab1'))
            ->with(compact('tab2'))
            ->with(compact('oeuvres'))->render();

        $oeuvreA = View::make('charts.oeuvreArtiste')
            ->with(compact('tab3'))
            ->with(compact('tab4'))
            ->with(compact('oeuvres'))->render();

        $map = View::make('map.map')
            ->with(compact('oeuvresLast'))
            ->render();


        return view('user.home')
            ->with(compact('general'))
            ->with(compact('oeuvreT'))
            ->with(compact('oeuvreA'))
            ->with(compact('map'))
            ->with(compact('oeuvresLast'));
    }
}
