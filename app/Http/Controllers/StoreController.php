<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $temp = DB::table('stores')->where('name', '=', $request->name)->first();
            if ($temp){
                return redirect('StoreController@update');
            }
            $store = new Store();
            $store->name = $request->name;
//            $store->email = $request->email;
            $store->owner_name = $request->owner_name;
            $store->address = $request->address;
            $store->save();
            return response()->json(['success'=>true,'message'=>'ثبت نام شما با موفقیت انچام شد']);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()]);
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
    public function update(Request $request, $id)
    {
//        $store = DB::table('stores')->where('name', '=', $request->name)->first();
//        $store->owner_name = $request->owner_name;
//        $store->address = $request->address;
//        $store->

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
