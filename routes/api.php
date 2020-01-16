<?php

use App\Off;
use App\QRCode;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//the route of checking the returned value by user, is it same?
Route::post('code',function (Request $request){
    try {
        $str = $request->str;
        $isSalesman = $request->isSalesman;
        $phone = $request->phone;
        $mac_address = $request->mac;
        $user = DB::table('users')->where('mac_address', '=', $mac_address)->first();
        return response()->json(['success'=>true,'message'=>$user]);
        //I have forced to do in this way, because we don't send SMS
    }catch (\Exception $exception){
        return response()->json(['success'=>false,'message'=>$exception->getMessage()]);
    }
});

//the route of login, sign up of users:
Route::resource('user','UserController');


//the route of doing game:
Route::post('game',function (Request $request){

    try{
        //two condition: a new player or a newbie
        $current_user = DB::table('users')->where('mac_address', '=', $request->mac)->first();
        if (!$current_user){
            $current_user = new User();
        }
        //we should check if the has sent QRCode is valid and which QRCode belongs to?
        $game_code = $request->game_code;
        $q_r_code = DB::table('q_r_codes')->where('code', '=', $game_code)->first();
        if (!$q_r_code){
            return response()->json(['success'=>false,'message'=>'چنین qrcode ای وجود ندارد']);
        }
        $store = DB::table('stores')->where('id', '=', $q_r_code->store_id)->first();

        $quiz_games = DB::table('quiz_games')->where('store_id', '=', $store->id)->get();

        //one player should'nt plays a certain game twice or more:
        foreach ($quiz_games as $game){

            $user = DB::table('game_user_table')->where('user_id', '=', $q_r_code->store_id)->first();

            if ($user){
                continue;
            }
            $questions = DB::table('questions')->where('quiz_game_id','=',$game->id)->get();
            $multi_options = [];
            $i = 0;
            foreach ($questions as $question) {
                $multi_options[$i] = DB::table('options')->where('question_id', '=', $question->id)->get();
                $i = $i + 1;
            }
            $offs = DB::table('offs')->where('quiz_game_id','=',$game->id)->get();
            $options = \App\Question::with('options')->get();

            return response()->json(['success'=>true,'questions'=>$questions,
                'options'=>$multi_options,
                'off_codes'=>$offs],200);
        }
           return response()->json(['success'=>false,'message'=>'با عرض پوزش بازی ای برای شما یافت نشد!']);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],500);
        }
});


//to interact with store:
Route::resource('store','StoreController');

//to interact(make,delete,update,...) with Off
Route::resource('off','OffController',['except'=>'create','edit']);

//to find out stores by offs and inversely:
Route::get('stores_to_off',function ($request){
    $stores = Store::all();
    $available = [];
    $i = 0;
    foreach ($stores as $store){
        if (!$store->offs()){
            continue;
        }
        $available[$i] = $store;
        $i = $i +1;
    }

    return respone()->json(['success'=>true,'message'=>$available]);
});

//to buy off by user:
Route::post('off_buy',function (Request $request){
    $user = User::find($request->user_id);
    $off = Off::find($request->off_id);
    if ($user->money <$off->product_price*(1-($off->percent)/100)){
        return response()->json(['successful'=>false,'message'=>'اعتبار شما کافی نیست']);
    }
    $user->money = $user->money - $off->product_price*(1-($off->percent)/100);
    $user->save();
    $off->count = $off->count - 1;
    if ($off->count == 0){
        $off->delete();
        return response()->json(['success'=>true,'این تخفیف تمام شد']);
    }
    $off->user_id = $user->id;
    $off->save();
    return response()->json(['successful'=>true,'message'=>'خرید شما با موفقیت انجام شد']);

});

//to charge the account of user:
Route::post('charge',function (Request $request){
    $pay = $request->pay;
    $user = User::find($request->user_id);

    return redirect()->route('BANK_GATEWAY', [$user]);
});

//created by AmirMohammad Karimi, email:amk9978@gmail.com

