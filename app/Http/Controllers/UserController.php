<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;

use Sentinel;

class UserController extends Controller
{
    public function show_profile()
    {
      $id = Sentinel::getUser()->id;
      $user = User::with('detail_user', 'job_request')->findOrFail($id);
      $job = Job::all();

      return view('user.show_profile', compact('user', 'job'));
    }

    public function show_notification()
    {
      $id = Sentinel::getUser()->id;
      $user = User::with('notifications')->findOrFail($id);
      $notif = $user->notifications()->orderBy('id', 'desc')->get();

      $user->notifications()->update([
        'seen' => 1,
      ]);

      return view('user.show_notification', compact('user', 'notif'));
    }

    public function edit_profile()
    {
      $id = Sentinel::getUser()->id;
      $user = User::with('detail_user')->findOrFail($id);

      return view('user.update_profile', compact('user'));
    }

    public function update(Request $request)
    {
      $this->validate($request, [
        'phone' =>  'required|max:12',
      ]);

      $user = User::find($request->id);
      $tgl  = $request->tgl;
      $bln  = $request->bln;
      $thn  = $request->thn;

      $gabung_tgl = $thn.'-'.$bln.'-'.$tgl;

      //cek gender user untuk set avatar
      if($request->gender == 'Pria')
        $photo = 'avatar-male.png';
      else
        $photo = 'avatar-female.png';

      //update table detail_users
      $user->detail_user()->update([
        'first_name'    => $request->first_name,
        'last_name'     => $request->last_name,
        'phone'         => $request->phone,
        'gender'        => $request->gender,
        'birth'         => $gabung_tgl,
        'address'       => $request->address,
        'country'       => $request->country,
        'last_education'=> $request->last_education,
        'institute_name'=> $request->institute_name,
        'majors'        => $request->majors,
        'graduate_year' => $request->graduate_year,
        'photo'         => $photo,
      ]);


      //ubah status jadi dua, menandakan sudah lengkapi profile
      if($user->status != 3 && $user->status != 4)
      $user->update([
        'status'  => 2,
      ]);

      return redirect()->route('profile.show')->with('notice', 'Berhasil mengupdate profile!');
    }
}
