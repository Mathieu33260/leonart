<?php

namespace App\Http\Controllers\Oeuvres;

use App\Models\Artiste;
use App\Models\Oeuvre;
use App\Models\Type;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
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
        $oeuvres = Oeuvre::where('userId', auth()->user()->id)
            ->limit(10)
            ->get();

        $map = View::make('oeuvre.map')
            ->with(compact('oeuvres'))
            ->render();

        return view('oeuvre.index')
            ->with(compact('map'))
            ->with(compact('oeuvres'));
    }

    public function indexAjax($offset,$string = "")
    {
        if($string != "")
        {
            $oeuvres = Oeuvre::where('nom', 'like', '%'.$string.'%')
                ->where('userId', auth()->user()->id)
                ->orderBy('id','ASC')
                ->offset($offset)
                ->limit(10)
                ->get();
        } else {
            $oeuvres = Oeuvre::where('userId', auth()->user()->id)
                ->orderBy('id','ASC')
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
        $types = Type::where('userId', auth()->user()->id)
            ->pluck('libelle', 'id')->toArray();
        $artistes = Artiste::where('userId', auth()->user()->id)
            ->pluck('nom', 'id')->toArray();

        $map = View::make('oeuvre.mapCreate')
            ->render();

        return view('oeuvre.create')
            ->with(compact('types'))
            ->with(compact('artistes'))
            ->with(compact('map'));
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
            'idIbeacon' => 'required|integer|digits_between:0,6',
            'posX' => 'required|numeric',
            'posY' => 'required|numeric',
            'audio' => 'mimes:mpga,wav,ogg|nullable',
            'typeId' => 'integer|digits_between:0,3|nullable',
            'artisteId' => 'integer|digits_between:0,11|nullable',
            'description' => 'string|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable'
        ]);

        $image = $request->file('image');
        if(is_null($image))
        {
            $filename = null;
        } else {
            Storage::put('public/uploads/images/'.$image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            $filename = $image->getClientOriginalName();
        }

        $audio = $request->file('audio');
        if(is_null($audio))
        {
            $filenameAudio = null;
        } else {
            Storage::put('public/uploads/audio/'.$audio->getClientOriginalName(), file_get_contents($audio->getRealPath()));
            $filenameAudio = $audio->getClientOriginalName();
        }

        $oeuvre = Oeuvre::create([
            'nom' => $request->input('nom'),
            'modele' => $request->input('modele'),
            'idIbeacon' => $request->input('idIbeacon'),
            'posX' => $request->input('posX'),
            'posY' => $request->input('posY'),
            'audio' => $filenameAudio,
            'typeId' => $request->input('typeId'),
            'artisteId' => $request->input('artisteId'),
            'userId' => auth()->user()->id,
            'description' => $request->input('description'),
            'image' => $filename
        ]);

        if ($oeuvre) {
            $request->flash("Oeuvre sauvegardé avec succès !");
        } else {
            $request->flash("Une erreur s'est produite.");
        }

        return redirect()->route('oeuvre:index');
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
      if(\request()->ajax()) {

        $oeuvre = Oeuvre::where('id', $oeuvreId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($oeuvre))
        {
            return redirect()->route('oeuvre:index');
        }

        return View::make('oeuvre.showAjax',compact('oeuvre'))->render();
     }

     return redirect()->route('oeuvre:index');
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
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($oeuvre))
        {
            return redirect()->route('oeuvre:index');
        }

        $types = Type::where('userId', auth()->user()->id)
            ->pluck('libelle', 'id')->toArray();
        $artistes = Artiste::where('userId', auth()->user()->id)
            ->pluck('nom', 'id')->toArray();

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
        $oeuvretest = Oeuvre::where('id', $oeuvreId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($oeuvretest))
        {
            return redirect()->route('oeuvre:index');
        }

        $this->validate($request, [
            'nom'     => 'required|string|max:255',
            'modele'     => 'string|nullable',
            'idIbeacon' => 'required|integer|digits_between:0,6',
            'posX' => 'required|numeric',
            'posY' => 'required|numeric',
            'audio' => 'mimes:mpga,wav,ogg|nullable',
            'typeId' => 'integer|digits_between:0,3|nullable',
            'artisteId' => 'integer|digits_between:0,11|nullable',
            'description' => 'string|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable'
        ]);

        $image = $request->file('image');
        if(is_null($image))
        {
            $filename = null;
        } else {
            Storage::put('public/uploads/images/'.$image->getClientOriginalName(), file_get_contents($image->getRealPath()));
            $filename = $image->getClientOriginalName();
        }

        $audio = $request->file('audio');
        if(is_null($audio))
        {
            $filenameAudio = null;
        } else {
            Storage::put('public/uploads/audio/'.$audio->getClientOriginalName(), file_get_contents($audio->getRealPath()));
            $filenameAudio = $audio->getClientOriginalName();
        }

        $oeuvre = Oeuvre::where('id', $oeuvreId)->update([
            'nom' => $request->input('nom'),
            'modele' => $request->input('modele'),
            'idIbeacon' => $request->input('idIbeacon'),
            'posX' => $request->input('posX'),
            'posY' => $request->input('posY'),
            'audio' => $filenameAudio,
            'typeId' => $request->input('typeId'),
            'artisteId' => $request->input('artisteId'),
            'userId' => auth()->user()->id,
            'description' => $request->input('description'),
            'image' => $filename
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
        $oeuvre = Oeuvre::where('id', $oeuvreId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($oeuvre))
        {
            return redirect()->route('oeuvre:index');
        }

        Oeuvre::where('id', $oeuvreId)->delete();

        return redirect()->route('oeuvre:index');
    }
}
