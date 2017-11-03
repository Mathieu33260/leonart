<?php

namespace App\Http\Controllers\Artiste;

use App\Models\Artiste;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artistes = Artiste::all();

        return view('artiste.index')->with(compact('artistes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artiste.create');
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
            'prenom'     => 'required|string|max:255',
            'dateN' => 'date',
            'dateM' => 'nullable|date'
        ]);

        $artiste = Artiste::create([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'dateN' => $request->input('dateN'),
            'dateM' => $request->input('dateM')
        ]);

        return redirect()->route('artiste:show',['id' => $artiste->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $artisteId
     * @return \Illuminate\Http\Response
     * @internal param Artiste $artiste
     */
    public function show(int $artisteId)
    {
        $artiste = Artiste::where('id', $artisteId)
            ->first();

        return view('artiste.show')->with(compact('artiste'));
    }

    public function showAjax(int $artisteId)
    {
        $artiste = Artiste::where('id', $artisteId)
            ->first();

        return $artiste->toArray();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $artisteId
     * @return \Illuminate\Http\Response
     * @internal param Artiste $artiste
     */
    public function edit(int $artisteId)
    {
        $artiste = Artiste::where('id', $artisteId)
            ->first();

        return view('artiste.edit')->with(compact('artiste'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $artisteId
     * @return \Illuminate\Http\Response
     * @internal param Artiste $artiste
     */
    public function update(Request $request, int $artisteId)
    {
        $this->validate($request, [
            'nom'     => 'required|string|max:255',
            'prenom'     => 'required|string|max:255',
            'dateN' => 'date',
            'dateM' => 'nullable|date'
        ]);

        $artiste = Artiste::where('id', $artisteId)->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'dateN' => $request->input('dateN'),
            'dateM' => $request->input('dateM')
        ]);

        /*if ($type) {
            flash(__("Profil sauvegardé avec succès !"))->success();
        } else {
            flash(__("Une erreur s'est produite."))->error();
        }*/

        return redirect()->route('artiste:show',['id' => $artisteId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $artisteId
     * @return \Illuminate\Http\Response
     * @internal param Artiste $artiste
     */
    public function destroy(int $artisteId)
    {
        $artiste = Artiste::where('id', $artisteId)->first();

        $artiste->oeuvres()->rawUpdate(['artisteId' => null]);
        $artiste->delete();

        /*if ($type) {
            flash(__("Profil sauvegardé avec succès !"))->success();
        } else {
            flash(__("Une erreur s'est produite."))->error();
        }*/

        return redirect()->route('artiste:index');
    }
}
