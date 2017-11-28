<?php

namespace App\Http\Controllers\Artiste;

use App\Models\Artiste;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ArtisteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artistes = Artiste::where('userId', auth()->user()->id)
            ->limit(10)
            ->get();

        return view('artiste.index')->with(compact('artistes'));
    }

    public function indexAjax($offset,$string = "")
    {
        if($string != "")
        {
            $artistes = Artiste::where('nom', 'like', '%'.$string.'%')
                ->orwhere('prenom', 'like', '%'.$string.'%')
                ->where('userId', auth()->user()->id)
                ->orderBy('id','ASC')
                ->offset($offset)
                ->limit(10)
                ->get();
        } else {
            $artistes = Artiste::where('userId', auth()->user()->id)
                ->orderBy('id','ASC')
                ->offset($offset)
                ->limit(10)
                ->get();
        }

        return $artistes->toArray();
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
            'dateM' => $request->input('dateM'),
            'userId' => auth()->user()->id
        ]);

        return redirect()->route('artiste:index');
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
      if(\request()->ajax()) {

        $artiste = Artiste::where('id', $artisteId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($artiste))
        {
            return redirect()->route('artiste:index');
        }


        return View::make('artiste.showAjax')
            ->with(compact('artiste'))
            ->render();
      }

      return redirect()->route('artiste:index');
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
        $artistetest = Artiste::where('id', $artisteId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($artistetest))
        {
            return redirect()->route('artiste:index');
        }

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
            'dateM' => $request->input('dateM'),
            'userId' => auth()->user()->id
        ]);

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
        $artiste = Artiste::where('id', $artisteId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($artiste))
        {
            return redirect()->route('artiste:index');
        }

        $artiste->oeuvres()->rawUpdate(['artisteId' => null]);
        $artiste->delete();

        return redirect()->route('artiste:index');
    }
}
