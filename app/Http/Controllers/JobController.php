<?php

namespace App\Http\Controllers;

use App\Models\Job;
use sentinel;
use App\Models\User;
use App\Models\Job_Request;
use App\Models\Notification;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function show($slug)
    {
      $user = Sentinel::getUser();
      $job  = Job::where('slug', $slug)->first();
      return view('job.show_job', compact('job', 'user'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
      'description' => 'required',
      'cv'          => 'required|mimes:pdf|max: 10000'
    ]);

      $user = Sentinel::getUser();
      $cv   = $user->email.'.pdf';
      $request->file('cv')->storeAs('public\cv', $cv);

      //Insert mass assignment
      $job_request = Job_Request::create([
        'description' => $request->description,
        'user_id'     => $request->user_id,
        'job_id'      => $request->job_id,
        'cv'          => $cv,
      ]);

      //update status user = 3, menandakan user telah melamar dan upload cv..
      $user2 = User::find($user->id);
      $user2->update([
        'status'  =>  3,
      ]);

      //kirim notif ke admin
      $user = $user2->detail_user;

        Notification::create([
          'subject' => 'Hai admin! ada lamaran masuk dari user '.$user->first_name,
          'user_id' => 1,
        ]);

      return redirect()->route('profile.show')->with('notice', 'Lamaran berhasil dikirim, mohon menunggu info selanjutnya dari HRD kami!');
    }

    public function reupload(Request $request)
    {

      $this->validate($request, [
      'cv'          => 'required|mimes:pdf|max: 10000'
    ]);

      $id = Sentinel::getUser()->id;
      $user = User::find($id);
      $job_status = $user->job_request->status;

      if($job_status == 'accepted' or $job_status == 'rejected')
        return redirect()->route('profile.show')
               ->with('warning','Hanya dapat upload ulang saat status cv masih unread..');

      $old_cv   = $user->job_request->cv;
      $request->file('cv')->storeAs('public\cv', $old_cv);

      $user->job_request()->update([
        'cv'          => $old_cv,
      ]);

      return redirect()->route('profile.show')->with('notice', 'CV berhasil diupload ulang!');
    }
}
