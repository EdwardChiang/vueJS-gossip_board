<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Auth\authController;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;

use Input;
use Validator;

/*
* the new use
*/
use Auth;
use DB;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class articleController extends Controller
{
    static function get($join_index, $relation, $join_data)
    {
        if(Auth::check()) {
            $articleData = DB::table('articles')
                ->join('users', 'articles.uid', '=', 'users.id')
                ->select('articles.*', 'users.name')
                ->where('articles.status', 0)
                ->where($join_index, $relation, $join_data)
                ->orderBy('articles.created_at', 'desc')
                ->get();
            $replyData = replyController::get();

            for($j = 0; $j < count($articleData); $j++) {
                if($articleData[$j]->updated_at != '0000-00-00 00:00:00') $latestDate = $articleData[$j]->updated_at;
                else $latestDate = $articleData[$j]->created_at;
                $articleData[$j]->reply = [];
                for ($i = 0; $i < count($replyData); $i++) {
                    if($replyData[$i]->aid == $articleData[$j]->id) {
                        array_push($articleData[$j]->reply, $replyData[$i]);
                        if($latestDate < $replyData[$i]->created_at) $latestDate = $replyData[$i]->created_at;
                    }
                }
                $articleData[$j]->latestDate = $latestDate;
            }

            for($j = 0; $j < count($articleData); $j++) {
                for($i = 0; $i < count($articleData); $i++) {
                    if($articleData[$j]->latestDate > $articleData[$i]->latestDate) {
                        $temp = $articleData[$j];
                        $articleData[$j] = $articleData[$i];
                        $articleData[$i] = $temp;
                    }
                }
            }

            return $articleData;
        } else {
            return Redirect::to('/');
        }
    }

    static function create(Request $request)
    {
        if(Auth::check()) {
            $article_data['uid'] = Auth::user()->id;
            /*$article_data['title'] = $request->input('title');
            $article_data['content'] = $request->input('content');
            $article_data['status'] = 0;*/
            //return Input::file();
            if(Input::file('unityFile')) $article_data['game'] = 1;
            else $article_data['game'] = 0;
            $article_data['title'] = Input::all()['title'];
            $article_data['content'] = Input::all()['content'];
            $article_data['status'] = 0;
            $id = DB::table('articles')->insertGetId($article_data);
            if(Input::file('unityFile')) {
                Input::file('unityFile')->move('./unityData/' . $id, 'game.unity3d');
            }

            return Redirect::to('/');
            //return 0;
        } else {
            return Redirect::to('/');
        }
    }

    static function update(Request $request)
    {
        if(Auth::check()) {
            $aid = $request->input('aid');
            $articleInf = self::get('articles.id', '=', $aid);
            if($articleInf[0]->uid == Auth::user()->id) {
                $article_data['title'] = $request->input('title');
                $article_data['content'] = $request->input('content');
                $article_data['updated_at'] = DB::raw('CURRENT_TIMESTAMP');
                $article_data['status'] = 0;
                DB::table('articles')
                    ->where('id', $aid)
                    ->update($article_data);
                return 0;
            } else {
                return 1;
            }
        } else {
            return Redirect::to('/');
        }
    }

    static function delete(Request $request)
    {
        if(Auth::check()) {
            $aid = $request->input('aid');
            $articleInf = self::get('articles.id', '=', $aid);
            if($articleInf[0]->uid == Auth::user()->id) {
                $article_data['status'] = 1;
                DB::table('articles')
                    ->where('id', $aid)
                    ->update($article_data);
                return 0;
            } else {
                return 1;
            }
        } else {
            return Redirect::to('/');
        }
    }
}
