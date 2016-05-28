<?php
namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
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



class authController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    protected $redirectPath = '/check';
    protected $username = 'account';

    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'getLogout']);
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
       /*$this->auth = $auth;
       $this->registrar = $registrar;
       $this->middleware('guest', ['except' => 'getLogout']);*/
    }

    public function getAccount()
    {
        $data = DB::table('users')->lists('account');
        return $data;
    }


    public function register(Request $request)
    {
        $list_account = authController::getAccount();
        $isExist = array_search($request->input('account'), $list_account);

        if($request->input('account') == "" || $request->input('password') == "" || $request->input('name') == "") {
            return Redirect::to('/register/1');
        } else if($isExist !== FALSE) {
            return Redirect::to('/register/2');
        } else if($request->input('password') != $request->input('confirm_password')) {
            return Redirect::to('/register/3');
        }

        $account_data['account'] = $request->input('account');
        $account_data['name'] = $request->input('name');
        $account_data['password'] = bcrypt($request->input('password'));
        DB::table('users')->insert($account_data);
        return Redirect::to('/');
        //return DB::table('users')->insertGetId($account_data);
    }

    public function login(Request $request)
    {
        if(Auth::attempt([
            'account' => $request->input('account'),
            'password' => $request->input('password')
        ], $request->input('remember'))){
            Auth::user()->types = 0;
            return Redirect::to('/');
        } else {
            $list_account = authController::getAccount();
            $isExist = array_search($request->input('account'), $list_account);

            if($request->input('account') == "" || $request->input('password') == "") {
                return Redirect::to('/login/1');
            } else if($isExist === FALSE) {
                return Redirect::to('/login/2');
            } else {
                return Redirect::to('/login/3');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return Redirect::to('/');
    }
}
