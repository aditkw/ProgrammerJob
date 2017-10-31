<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job_Request;
use App\Models\Notification;
use App\Models\User;
use App\Models\Job;

class AdminController extends Controller
{
    //=========dashboard=========
    public function dashboard()
    {
      $user = User::where(function($query){
              $query->where('status', '<>', 4);
            })->where(function($query){
              $query->where('status', '<>', 5);
            })->count();

      $unread = Job_Request::where('status', 'unread')->count();
      $accepted = Job_Request::where('status', 'accepted')->count();
      $rejected = Job_Request::where('status', 'rejected')->count();
      return view('admin.dashboard', compact('user', 'unread', 'accepted', 'rejected'));
    }
    //=========end dashboard=========

    //=========function manage user=========
    public function show_user()
    {
      $user = User::where(function($query){
              $query->where('status', '<>', 4);
            })->where(function($query){
              $query->where('status', '<>', 5);
            })->get();

      return view('admin.show_user', compact('user'));
    }

    public function block($id)
    {
      $user = User::where('id', $id)->first();
      $user->update([
        'status_before' => $user->status,
        'status'        =>  5,
      ]);

      $pesan = 'berhasil memblokir user '.$user->detail_user->first_name;

      return response()->json(['pesan' => $pesan]);
    }

    public function unblock($id)
    {
      $user = User::where('id', $id)->first();
      $user->update([
        'status'  =>  $user->status_before,
      ]);
      $pesan = 'berhasil unblock user '.$user->detail_user->first_name;

      return response()->json(['pesan' => $pesan]);
    }

    public function show_blocked()
    {
      $user = User::where('status', 5)->get();

      return view('admin.show_blocked', compact('user'));
    }

    public function destroy_user($id)
    {
      $user = User::where('id', $id)->first();
      $pesan = 'User '.$user->detail_user->first_name.' berhasil dihapus';
      $user->destroy($id);
      return response()->json(['pesan' => $pesan]);
    }

    //=========end manage user=========

    //=========function job_request=========
    public function application_unread()
    {
      $application = Job_Request::with('user.detail_user')->where('status', 'unread')->get();
      return view('admin.application_unread', compact('application'));
    }

    public function application_accepted()
    {
      $application = Job_Request::with('user.detail_user')->where('status', 'accepted')->get();
      return view('admin.application_accepted', compact('application'));
    }

    public function application_show($id)
    {
      $application = Job_Request::with('user.detail_user')->where('id', $id)->first();

      if($application->status != 'rejected'){
        $application->update([
          'status'  => 'accepted',
        ]);

        $user = $application->user->detail_user;

        $admin = User::with('notifications')->findOrFail(1);

        $admin->notifications()->update([
          'seen' => 1,
        ]);

        $notif_user  = Notification::where('user_id', $application->user->id)->first();

        if ($notif_user != null) {
          $notif_user->destroy($notif_user->id);
        }

        $jumlah_notif = Notification::where(function($query) use($user){
                        $query->where('subject', 'LIKE', '%Hai '.$user->first_name.'! %');
                      })->where(function($query) use($user){
                        $query->where('user_id', $user->user_id);
                      })->count();

        if ($jumlah_notif < 1) {
          Notification::create([
            'subject' => 'Hai '.$user->first_name.'! admin telah membaca lamaran kamu, silahkan cek status lamaran..',
            'user_id' => $user->user_id,
          ]);
        }
      }

      return view('admin.application_show', compact('application', 'id'));
    }

    public function application_rejected()
    {
      $application = Job_Request::with('user.detail_user')->where('status', 'rejected')->get();
      return view('admin.application_rejected', compact('application'));
    }

    public function reject($id)
    {
      $application = Job_Request::find($id);
      $application->update([
        'status'  => 'rejected',
      ]);

      $user = $application->user->detail_user;
      $jumlah_notif= Notification::where(function($query) use($user){
                      $query->where('subject', 'LIKE', '%Dear '.$user->first_name.', %');
                    })->where(function($query) use($user){
                      $query->where('user_id', $user->user_id);
                    })->count();

      if ($jumlah_notif < 1) {
        Notification::create([
          'subject' => 'Dear '.$user->first_name.', mohon maaf admin kami menolak lamaran kamu, silahkan cek status lamaran..',
          'user_id' => $user->user_id,
        ]);
      }

      return redirect()->back()->with('notice', 'Lamaran telah di reject');
    }

    public function destroy($id)
    {
      $application = Job_Request::with('user')->find($id);
      $application->destroy($id);

      $user = $application->user->detail_user;
      $jumlah_notif= Notification::where(function($query) use($user){
                      $query->where('subject', 'LIKE', '%Halo '.$user->first_name.', apa kabar?%');
                    })->where(function($query) use($user){
                      $query->where('user_id', $user->user_id);
                    })->count();

      if ($jumlah_notif < 1) {
        $buat = Notification::create([
          'subject' => 'Haloo '.$user->first_name.', apa kabar? Lamaran kamu yg telah direject telah dihapus oleh admin, sekarang kamu bisa melamar ulang kembali..',
          'user_id' => $user->user_id,
        ]);
      }

      $user_id = $buat->user_id;
      $notif = Notification::where('user_id', $user_id)->get();

      foreach ($notif as $notif) {
        if ($notif->id < $buat->id) {
          $notif->destroy($notif->id);
        }
      }

      $application->user->update([
        'status' => 2,
      ]);

      return redirect()->back()->with('notice', 'Lamaran telah di hapus');
    }
    //=========end function job_request=========

    //=========function job=========
    public function new_job()
    {
      return view('admin.new_job');
    }

    public function job_list()
    {
      $job = Job::all();
      return view('admin.job_list', compact('job'));
    }

    public function create_job(Request $request)
    {
      if ($request->ajax()) {
        var_dump($request->all());
        $this->validate($request, [
        'name'           => 'required',
        'salary'         => 'required',
        'description'    => 'required',
        'photo'          => 'required|mimes:png,jpg,jpeg|max:2000'
      ]);

        $photo   = str_slug($request->name).'.jpg';
        $request->file('photo')->storeAs('public\photo', $photo);

        $job = Job::create([
          'name'        => $request->name,
          'slug'        => str_slug($request->name),
          'description' => $request->description,
          'salary'      => $request->salary,
          'photo'       => $photo,
        ]);

          return response()->json(['pesan' => 'berhasil menambah data']);
      }


    }

    public function destroy_job($id)
    {
      $job         = Job::where('id', $id)->first();
      $job_request = Job_Request::where('job_id', $job->id)->get();

      foreach ($job_request as $job_req) {
        $id_user = $job_req->user_id;
        User::find($id_user)->update([
          'status'  => 2,
        ]);
      }

      $job->destroy($id);
      return response()->json(['pesan' => 'Job '.$job->name.' berhasil dihapus']);
    }

    //=========end job=========
}
