<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Owner;
use App\Models\Home;
use App\Http\Resources\HomeResource;

class HomeController extends Controller
{

     /**
     * Update Home fields
     */
    public function update_fields(Home $home, Owner $user, Request $request)
    {
        $home->address = $request->address;
        $home->bedrooms = $request->bedrooms;
        $home->bathrooms = $request->bathrooms;
        $home->total_area = $request->total_area;
        $home->purcharsed = $request->purcharsed;
        $home->value = $request->value;
        $home->discount = $request->discount;
        $home->owner_id = $user->id;
        $home->save();
        $user->homes()->save($home);
    }

    /**
     * Display a listing of the houses from user.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_all_properties($user_id)
    {
        $owner = Owner::findOrFail($user_id);
        return HomeResource::collection($owner->homes);
    }

    /**
     * Display a listing of the houses from user.
     *
     * @return \Illuminate\Http\Response
     */
    public function change_purcharsed($home_id, $purcharsed)
    {
        $home = Home::findOrFail($home_id);
        $home->purcharsed = $purcharsed;
        $home->save();
        return $home;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HomeResource::collection(Home::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Owner::findOrFail($request->owner_id);
        if(count($user->homes->where('purcharsed', 0)) <= 3)
        {
            $home = new Home;
            $this->update_fields($home, $user, $request);
            return HomeResource::collection(array($home));
        }
        else
        {
           return response()->json(['data'=>'No more houses allowed'], 406);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return HomeResource::collection(array(Home::findOrFail($id)));
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
        $home = Home::findOrFail($id);
        $user = Owner::findOrFail($home->owner->id);
        $this->update_fields($home, $user, $request);
        return HomeResource::collection(array($home));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Home::destroy($id))
            return response()->json([
                'status' => 'ok'
            ], 202);
        else
            return response()->json([
                'status' => 'error'
            ], 406);
    }
}
