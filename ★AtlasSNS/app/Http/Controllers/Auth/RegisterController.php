<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    //ここで新規ユーザーの登録条件を記述している
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
            'password_confirmation' => 'min:4',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }

    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
//dd($data);
            $validator = $this->validator($data);
            if ($validator->fails()){
                return redirect('register')///行き先を変更してあげよう！！！login→registerに変更。バリデーションに引っ掛かると再度registerが読み込まれるようになっているぞ〜
                ->withErrors($validator)
                ->withInput();
                //$validator = $this->validator($data);の$validatarは、一旦記述してあげないとエラーが出てしまうので記述する。
            }

            $this->create($data);
            //セミコロンすれば連続でメゾット発動できるよ
            return redirect('added')->with('username',$data['username']);
            //withじゃないよ多分compact、→withで続行

}
        return view('auth.register');

    }
    public function added(){
        return view('auth.added');
    }
}
