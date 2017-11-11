<?php

namespace App\Http\Controllers\Oeuvres;

use App\Models\Artiste;
use App\Models\Oeuvre;
use App\Models\Type;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class OeuvresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oeuvres = Oeuvre::limit(10)
            ->get();

        return view('oeuvre.index')->with(compact('oeuvres'));
    }

    public function indexAjax($offset,$string = "")
    {
        if($string != "")
        {
            $oeuvres = Oeuvre::where('nom', 'like', '%'.$string.'%')
                ->orderBy('id','ASC')
                ->offset($offset)
                ->limit(10)
                ->get();
        } else {
            $oeuvres = Oeuvre::orderBy('id','ASC')
                ->offset($offset)
                ->limit(10)
                ->get();
        }

        return $oeuvres->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::pluck('libelle', 'id')->toArray();
        $artistes = Artiste::pluck('nom', 'id')->toArray();

        return view('oeuvre.create')
            ->with(compact('types'))
            ->with(compact('artistes'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nom'     => 'required|string|max:255',
            'modele'     => 'string|nullable',
            'idIbeacon' => 'required|integer|digits_between:0,3',
            'posX' => 'required|numeric',
            'posY' => 'required|numeric',
            'audio' => 'string|nullable',
            'typeId' => 'integer|digits_between:0,3|nullable',
            'artisteId' => 'integer|digits_between:0,11|nullable'
        ]);



        $oeuvre = Oeuvre::create([
            'nom' => $request->input('nom'),
            'modele' => $request->input('modele'),
            'idIbeacon' => $request->input('idIbeacon'),
            'posX' => $request->input('posX'),
            'posY' => $request->input('posY'),
            'audio' => $request->input('audio'),
            'typeId' => $request->input('typeId'),
            'artisteId' => $request->input('artisteId'),
            'userId' => auth()->user()->id
        ]);

        if ($oeuvre) {
            $request->flash("Oeuvre sauvegardé avec succès !");
        } else {
            $request->flash("Une erreur s'est produite.");
        }

        return redirect()->route('oeuvre:show',['id' => $oeuvre->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $oeuvreId
     * @return \Illuminate\Http\Response
     * @internal param Oeuvre $oeuvre
     */
    public function show(int $oeuvreId)
    {
        $oeuvre = Oeuvre::where('id', $oeuvreId)
            ->first();

        if(\request()->ajax()) {
            return View::make('oeuvre.showAjax',compact('oeuvre'))->render();
        }

        return view('oeuvre.show')->with(compact('oeuvre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $oeuvreId
     * @return \Illuminate\Http\Response
     * @internal param Oeuvre $oeuvre
     */
    public function edit(int $oeuvreId)
    {
        $oeuvre = Oeuvre::where('id', $oeuvreId)
            ->first();

        $types = Type::pluck('libelle', 'id')->toArray();
        $artistes = Artiste::pluck('nom', 'id')->toArray();

        return view('oeuvre.edit')
            ->with(compact('oeuvre'))
            ->with(compact('types'))
            ->with(compact('artistes'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $oeuvreId
     * @return \Illuminate\Http\Response
     * @internal param Oeuvre $oeuvre
     */
    public function update(Request $request, int $oeuvreId)
    {
        $this->validate($request, [
            'nom'     => 'required|string|max:255',
            'modele'     => 'string|nullable',
            'idIbeacon' => 'required|integer|digits_between:0,3',
            'posX' => 'required|numeric',
            'posY' => 'required|numeric',
            'audio' => 'string|nullable',
            'typeId' => 'integer|digits_between:0,3|nullable',
            'artisteId' => 'integer|digits_between:0,11|nullable'
        ]);

        $oeuvre = Oeuvre::where('id', $oeuvreId)->update([
            'nom' => $request->input('nom'),
            'modele' => $request->input('modele'),
            'idIbeacon' => $request->input('idIbeacon'),
            'posX' => $request->input('posX'),
            'posY' => $request->input('posY'),
            'audio' => $request->input('audio'),
            'typeId' => $request->input('typeId'),
            'artisteId' => $request->input('artisteId'),
            'userId' => auth()->user()->id
        ]);

        if ($oeuvre) {
            $request->flash("Oeuvre sauvegardé avec succès !");
        } else {
            $request->flash("Une erreur s'est produite.");
        }

        return redirect()->route('oeuvre:show',['id' => $oeuvreId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $oeuvreId
     * @return \Illuminate\Http\Response
     * @internal param Oeuvre $oeuvre
     */
    public function destroy(int $oeuvreId)
    {
        Oeuvre::where('id', $oeuvreId)->delete();

        /*if ($type) {
            flash(__("Profil sauvegardé avec succès !"))->success();
        } else {
            flash(__("Une erreur s'est produite."))->error();
        }*/

        return redirect()->route('oeuvre:index');
    }
}
