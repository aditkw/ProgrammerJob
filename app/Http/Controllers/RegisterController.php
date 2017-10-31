<?php

namespace App\Http\Controllers;

use Sentinel;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Detail_User;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

class RegisterController extends Controller
{
    public function signup()
    {
      return view('auth.signup');
    }

    public function signup_store(UserRequest $request)
    {
      //input ke table user menggunakan sentinel
      $credentials = [
        'email'     => $request->email,
        'password'  => $request->password,
      ];
      $create = Sentinel::registerAndActivate($credentials);

      //find user yg telah dibuat
      $user = User::where('email', $request->email)->first();

      //generate token random untuk verifikasi
      $user->update([
        'token' => str_random(20),
      ]);

      //input first dan last name ke detai_user beserta user_id
      $user->detail_user()->create([
        'first_name'  =>  $request->first_name,
        'last_name'   =>  $request->last_name,
      ]);

      //attach role sebagai user
      $user->roles()->attach(2);

      //kirim email untuk verifikasi
      Mail::to($user->email)->send(new UserRegistered($user));

      Session::flash('warning', 'Berhasil mendaftar, silahkan verifikasi melalui email..');
      return redirect()->route('login');
    }

    public function verification($token, $id)
    {
      $user = User::findOrFail($id);
      $token_db = $user->token;

      if ($token_db != $token) {
        return redirect()->route('login')->with('error', 'Token tidak cocok!');
      }

      if($user->status == 0){
        $user->status = 1;
        $user->save();
        return redirect()->route('login')->with('notice', 'Akun telah diaktifkan! Silahkan login..');
      }

      return redirect()->route('login');
    }

}
