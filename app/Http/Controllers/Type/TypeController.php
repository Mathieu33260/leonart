<?php

namespace App\Http\Controllers\Type;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::where('userId', auth()->user()->id)
            ->limit(10)
            ->get();

        return view('type.index')->with(compact('types'));
    }

    public function indexAjax($offset,$string = "")
    {
        if($string != "")
        {
            $types = Type::where('libelle', 'like', '%'.$string.'%')
                ->where('userId', auth()->user()->id)
                ->orderBy('id','ASC')
                ->offset($offset)
                ->limit(10)
                ->get();
        } else {
            $types = Type::where('userId', auth()->user()->id)
                ->orderBy('id','ASC')
                ->offset($offset)
                ->limit(10)
                ->get();
        }

        return $types->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('type.create');
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
            'libelle'     => 'required|string|max:255'
        ]);

        $type = Type::create([
            'libelle' => $request->input('libelle'),
            'userId' => auth()->user()->id
        ]);

        return redirect()->route('type:show',['id' => $type->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $typeId
     * @return \Illuminate\Http\Response
     * @internal param Type $type
     */
    public function show(int $typeId)
    {
        $type = Type::where('id', $typeId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($type))
        {
            return redirect()->route('type:index');
        }

        if(\request()->ajax()) {
            return View::make('type.showAjax',compact('type'))->render();
        }

        return view('type.show')->with(compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $typeId
     * @return \Illuminate\Http\Response
     * @internal param Type $type
     */
    public function edit(int $typeId)
    {
        $type = Type::where('id', $typeId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($type))
        {
            return redirect()->route('type:index');
        }

        return view('type.edit')->with(compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $typeId
     * @return \Illuminate\Http\Response
     * @internal param Type $type
     */
    public function update(Request $request, int $typeId)
    {
        $typetest = Type::where('id', $typeId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($typetest))
        {
            return redirect()->route('type:index');
        }

        $this->validate($request, [
            'libelle'     => 'required|string|max:255'
        ]);

        $type = Type::where('id', $typeId)->update([
            'libelle' => $request->input('libelle'),
            'userId' => auth()->user()->id
        ]);

        return redirect()->route('type:show',['id' => $typeId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $typeId
     * @return \Illuminate\Http\Response
     * @internal param Type $type
     */
    public function destroy(int $typeId)
    {
        $type = Type::where('id', $typeId)
            ->where('userId', auth()->user()->id)
            ->first();

        if(is_null($type))
        {
            return redirect()->route('type:index');
        }

        $type->oeuvres()->rawUpdate(['typeId' => null]);
        $type->delete();

        return redirect()->route('type:index');
    }
}
