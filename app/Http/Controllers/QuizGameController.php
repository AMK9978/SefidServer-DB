<?php

namespace App\Http\Controllers;

use App\QRCode;
use App\Store;
use Illuminate\Http\Request;

class QuizGameController extends Controller
{
    public function check(Request $request)
    {
//        try{
//        $game_code = $request->game_code;
//        $qr_codes = QRCode::all();
//        foreach ($qr_codes as $code){
//            if ($code == $game_code){
//                //find relevant store
//                $store = $code->store();
//                $quiz_games = $store->quiz_game();
//                $not_found = false;
//                foreach ($quiz_games as $game){
//                    $users = $game->users();
//                    foreach ($users as $user){
//                        if ($user->mac == $request->mac){
//                            $not_found = true;
//                            break;
//                        }
//                    }
//                    if ($not_found == false){
//                        //send questions
//                        //send options and answer
//                        //send off_code
//                        $questions = $game->questions();
//                        return response()->json(['questions'=>$questions,
//                            'off_code'=>$game->off_code],200);
//                    }
//                }
//               return response()->json(['message'=>'با عرض پوزش بازی ای برای شما یافت نشد!']);
//            }
//        }
//        }catch (\Exception $exception){
//            return response()->json(['message'=>$exception->getMessage()],500);
//        }


    }


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
//        $this->check($request);
        return response()->json('hi');
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
        //
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
