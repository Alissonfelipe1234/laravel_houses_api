<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Http\Resources\OwnerResource;

class OwnerController extends Controller
{
    /**
     * Update Owner fields
     */
    public function update_fields(Owner $owner, Request $request)
    {
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->save();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OwnerResource::collection(Owner::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $owner = new Owner;
        $this->update_fields($owner, $request);
        return OwnerResource::collection(array($owner));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return OwnerResource::collection([Owner::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $owner = Owner::findOrFail($id);
        $this->update_fields($owner, $request);
        return OwnerResource::collection(array($owner));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Owner::destroy($id))
            return response()->json([
                'status' => 'ok'
            ], 202);
        else
            return response()->json([
                'status' => 'error'
            ], 406);
    }
}
