<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Session;
use App\Http\Requests\SessionRequest;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    public function login()
    {
      if ($user = Sentinel::check())
      {
      Session::flash("notice", "Kamu sudah login ".$user->first_name);
      return redirect()->route('profile.show');
      }

      else
      return view('auth.login');
    }

    public function login_store(SessionRequest $request)
    {
      //cek apakah user sudah authenticate
       if($user = Sentinel::authenticate($request->all()))
       {
         //ambil id dari model/table user
         $cek_user = User::with('detail_user')->where('id', Sentinel::getUser()->id)->first();

         //cek status user

         if(Sentinel::inRole('admin')){
           return redirect()->route('admin.dashboard');
         }

         elseif($cek_user->status == 0){
              Sentinel::logout();
              return redirect()->route('login')->with('warning', 'akun belum diaktifkan, silahkan verifikasi melalui email kamu..');
            }

          else if($cek_user->status == 1){
             Session::flash("notice", "Welcome ".$cek_user->detail_user->first_name.'! Silahkan lengkapi profil terlebih dahulu..');
             return redirect()->route('profile.edit');
          }

          else if($cek_user->status == 2 or $cek_user->status == 3){
            Session::flash("notice", "Haloo ".$cek_user->detail_user->first_name.'! Semoga harimu menyenangkan..');
            return redirect()->route('profile.show');
          }
          else if($cek_user->status == 5 ){
            Sentinel::logout();
            Session::flash("warning", "Dear ".$cek_user->detail_user->first_name.', mohon maaf akun kamu kami blokir. Untuk info lebih lanjut silahkan kontak admin..');
            return redirect()->route('login');
          }

       }
       else{
         Session::flash("error", "Email atau password tidak cocok!");
         return redirect()->route('login');
       }
   }

     public function logout()
     {
       $id = Sentinel::getUser()->id;
       $user = User::where('id', $id)->first();
       Sentinel::logout();
       Session::flash("notice", "Berhasil logout, sampai jumpa lagi ".$user->detail_user->first_name.'!');
       return redirect()->route('login');
     }

}
