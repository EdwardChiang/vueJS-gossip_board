<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Auth\authController;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;


/*
* the new use
*/
use Auth;
use DB;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class replyController extends Controller
{
    static function get()
    {
        if(Auth::check()) {
            $replyData = DB::table('reply')
                ->join('users', 'reply.uid', '=', 'users.id')
                ->select('reply.*', 'users.name')
                ->orderBy('reply.created_at', 'desc')
                ->get();
            return $replyData;
        } else {
            return Redirect::to('/');
        }
    }

    static function create(Request $request)
    {
        if(Auth::check()) {
            $reply_data['uid'] = Auth::user()->id;
            $reply_data['aid'] = $request->input('aid');
            $reply_data['content'] = $request->input('content');
            $reply_data['content_img'] = $request->input('content_img');

            $return_id = DB::table('reply')->insertGetId($reply_data);
            DB::table('articles')
                ->where('id', $request->input('aid'))
                ->update(['updated_at' => DB::raw('CURRENT_TIMESTAMP')]);
            $return_data = DB::table('reply')
                ->select('reply.*')
                ->where('id', '=', $return_id)
                ->get();
            return [$return_data[0], Auth::user()];
        } else {
            return Redirect::to('/');
        }
    }

    static function getOne(Request $request)
    {
        if(Auth::check()) {
            $aid = $request->input('aid');
            $replyData = DB::table('reply')
                ->join('users', 'reply.uid', '=', 'users.id')
                ->select('reply.*', 'users.name')
                ->where('reply.aid', '=', $aid)
                ->orderBy('reply.created_at', 'desc')
                ->get();
            return $replyData;
        } else {
            return Redirect::to('/');
        }
    }
}