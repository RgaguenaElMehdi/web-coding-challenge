<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Like;
use App\Dislike;
use Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function show()
     {
       DelDislike();

       return view('welcome');
     }
     public function likedshop()
     {

       return view('pref');
     }
     public function liked()
     {
       //select all liked shops with connected user
       $uid= Auth::check() ? Auth::user()->id : 'null';
       $shops = DB::table('shops')
       ->join('likes', function($join) {
         $join->on('shops.id_oid', '=', 'likes.s_id')
              ->on('likes.u_id', '=', 'likes.u_id');
       })
       ->where('u_id',$uid)
   ->get();


       return response()->json($shops);
     }
    public function index()
    {
      // if localy client ip will get 127.0.0.1
      //$clientIP = request()->ip();
      $clientIP = '41.140.197.188';

      //get ip  loatitude and langetude
      $lat=getlocation($clientIP)->lat;
      $lng=getlocation($clientIP)->lon;



      //function to get all shops filtred by nearby one and with out desiliked shop addn liked one
      $uid= Auth::check() ? Auth::user()->id : 'null';
      $shops=orderbydist($lat,$lng,$uid);

       return response()->json($shops);
    }


    public function storelike($id)
    {
        //dd($id);



        $like = new like;
        $like->u_id       = Auth::user()->id;
        $like->s_id      = $id;


        $like->save();
        return redirect()->route('shop');

    }
    public function dislike($id)
    {
        //dd($id);



        $dislike = new Dislike;
        $dislike->u_id       = Auth::user()->id;
        $dislike->s_id      = $id;


        $dislike->save();
        return redirect()->route('shop');

    }

    public function destroy($id)
    {
        Like::destroy($id);
        return redirect()->route('pref');
    }
}
