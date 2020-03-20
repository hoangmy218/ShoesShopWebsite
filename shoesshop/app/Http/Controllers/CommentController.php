<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Comment;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

session_start();

class CommentController extends Controller
{
    // Tiên 14/03
    public function postComment(Request $request, $id){
         $data = new Comment; // cách 1 insert vào model Comment
        
        
        $data->bl_email = $request->email;
        $data->bl_ten = $request->name;
        $data->bl_noidung = $request->content;
        $data->sp_ma = $id;
        $data->save();
    
        return back(); 

        //$data= array(); // cách 2 insert vo bảng
        // $data['bl_email'] = $request->email;
        // $data['bl_ten'] = $request->name;
        // $data['bl_noidung'] = $request->content;
        // $data['sp_ma'] = $id;
        // DB::table('binhluan')->insert($data); 
        // return Redirect::to('/show_detail/'.$id); 
    }   
}
