<?php

namespace App\Http\Controllers;

use App\Models\Artiste;
use App\Models\Oeuvre;
use App\Models\Type;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $type = Type::all();
        $artiste = Artiste::all();

        $oeuvreOrd = DB::table('oeuvre')
            ->join('type', 'oeuvre.typeId', '=', 'type.id')
            ->where('oeuvre.userId', auth()->user()->id)
            ->select('type.libelle', DB::raw('count(*) as total'))
            ->groupBy('libelle')
            ->get()
            ->toArray();

        $tab1 = array();
        $tab2 = array();
        foreach($oeuvreOrd as $oeuvree)
        {
            array_push($tab1,$oeuvree->libelle);
            array_push($tab2,$oeuvree->total);
        }

        $general = View::make('charts.general')
            ->with(compact('type'))
            ->with(compact('artiste'))
            ->with(compact('oeuvres'))->render();

        $oeuvreV = View::make('charts.oeuvre')
            ->with(compact('tab1'))
            ->with(compact('tab2'))
            ->with(compact('oeuvres'))->render();

        $map = View::make('map.map')
            ->with(compact('oeuvres'))
            ->render();


        return view('home')
            ->with(compact('general'))
            ->with(compact('oeuvreV'))
            ->with(compact('map'));
    }
}
