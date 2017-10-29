<?php

namespace App\Http\Controllers\Oeuvres;

use App\Models\Artiste;
use App\Models\Oeuvre;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OeuvresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oeuvres = Oeuvre::all();

        return view('oeuvre.index')->with(compact('oeuvres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('oeuvre.create');
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
            'modele'     => 'string',
            'idIbeacon' => 'required|integer|size:3',
            'posX' => 'required|numeric',
            'posY' => 'required|numeric',
            'audio' => 'string',
            'typeId' => 'required|integer|size:3',
            'artisteId' => 'integer|size:11',
            'userId' => 'required|integer|size:10'
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

        $types = Type::pluck('libelle', 'id');
        $artistes = Artiste::pluck('prenom', 'nom', 'id');

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
            'modele'     => 'string',
            'idIbeacon' => 'required|integer|size:3',
            'posX' => 'required|numeric',
            'posY' => 'required|numeric',
            'audio' => 'string',
            'typeId' => 'required|integer|size:3',
            'artisteId' => 'integer|size:11',
            'userId' => 'required|integer|size:10'
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

        /*if ($type) {
            flash(__("Profil sauvegardé avec succès !"))->success();
        } else {
            flash(__("Une erreur s'est produite."))->error();
        }*/

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
