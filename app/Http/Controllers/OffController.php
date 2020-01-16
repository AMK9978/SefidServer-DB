<?php

namespace App\Http\Controllers;

use App\Off;
use App\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $off = new Off();
        $off->product_name = $request->product_name;
        $off->product_price = $request->product_price;
        $off->product_percent = $request->percent;
        $off->count = $request->price;
        $off->save();
        return response()->json(['success'=>true,'message'=>'با موفقیت ذخیره شد.'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $store = Store::find($id);
            $offs = DB::table('offs')->where('store_id', '=', $store->id)->get();
            return response(['success' => true, 'message' => $offs], 200);
        }catch (\Exception $exception){
            return response()->json($exception->getMessage());
        }
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

        $off = Off::find($id);
        if (!$off){
            return response()->json(['success'=>true,'message'=>'اطلاعات تخفیف مورد نظر موجود نبود']);
        }
        $off->product_name = $request->product_name;
        $off->product_price = $request->product_price;
        $off->product_percent = $request->percent;
        $off->count = $request->price;
        $off->save();
        return response()->json(['success'=>true,'message'=>'با موفقیت ذخیره شد.'],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $off = Off::find($id);
        if (!$off){
            return response()->json(['success'=>true,'message'=>'تخفیف مورد نظر یافت نشد']);
        }
        try {
            $off->delete();
            return response()->json(['success'=>true,'message'=>'تخفیف با موفقیت پاک شد']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'message'=>'خطا در سرور']);
        }

    }
}
