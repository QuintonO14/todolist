<?php

namespace App\Http\Controllers;

use App\Thing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $things = Thing::where('user_id','=', $user->id)->latest()->get();
        return view('todo.index',compact('things','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'headline' => 'required|min:3|max:15',
            'body' => 'required|min:6|max:250'
        ]);

        $input = $request->all();

        $user->things()->create($input);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $input = $request->all();

        $user->things()->create($input);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $thing = Thing::findOrFail($id);

        $this->validate($request, [
            'headline' => 'required|min:3|max:15',
            'body' => 'required|min:6|max:250'
        ]);

        $input = $request->all();

        $thing->fill($input)->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thing = Thing::findOrFail($id);

        $thing->delete();

        return redirect()->back();
    }
}
