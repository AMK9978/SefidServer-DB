<?php

namespace App\Http\Controllers;

use App\Code;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
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


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            $user = new User();
            $users = User::all();
            foreach ($users as $us){
                if ($us->mac_address == $request->mac){
                    $us->contact = $request->contact;
                    $us->save();
                    return response()->json(['success'=>true,'message' => 'کد مشتری تولید شد','success'=>true], 200);
                }
            }
                $user->contact = $request->phone;
                $user->mac_address = $request->mac;
                $user->save();
            return response()->json(['success'=>true,'message' => 'کد مشتری تولید شد'], 200);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],404);
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
        $user = User::find($id);
        $offs = $user->offs();
        return response()->json(['success'=>true,'message'=>$offs]);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
