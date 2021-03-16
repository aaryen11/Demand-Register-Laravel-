<?php

namespace App\Http\Controllers;
use App\RequestItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function requestview()
    {
        if(Auth::user()->usertype == 1) {
            return view('requestform');
        }
        else{
            return response(abort(403,''));
        }

    }

    public function viewrequest()
    {
        if(Auth::user()->usertype == 1) {
            return response(abort(403,''));
        }
        else if(Auth::user()->usertype == 2){
                $dept = Auth::user()->department;
                $data = DB::table('request_items')->where('department',$dept)->where('approval_status','pending')->simplepaginate(10);
                return view('viewrequest')->with('data',$data);
        }

        else if(Auth::user()->usertype == 3){
            $data = DB::table('request_items')->where('approval_status','approved_by_hod')->simplepaginate(10);
            return view('viewrequest')->with('data',$data);
        }

        else if(Auth::user()->usertype == 4){
            $data = DB::table('request_items')->where('approval_status','approved_by_moderator')->simplepaginate(10);
            return view('viewrequest')->with('data',$data);
        }
    }

    public function sendrequest(Request $request){
        if(Auth::user()->usertype == 1) {
            $data = new RequestItem([
                'made_by_email' => Auth::user()->email,
                'made_by' => $request->get('name'),
                'department' => $request->get('dept'),
                'made_to' => $request->get('dept'),
                'request_made_on' => date('W M Y'),
                'requested_item' => $request->get('requested_item'),
            ]);
            $data->save();
            return redirect()->back()->with("success","Request Sent");
        }
        else{
            return response(abort(403,''));
        }

    }


    public function disapprove($id)
    {
        if(Auth::user()->usertype == 2){
            $status = [
                'approval_status' => 'disapproved_by_hod'
             ];
             $user = DB::table('request_items')->where("id",$id)->pluck('made_by_email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             $beautymail->send('emails.notify', [], function($message) use ($user)
             {
                 $message
                     ->from('bar@example.com')
                     ->to($user[0],$user[0])
                     ->subject('Your Order has been Disapproved By HOD!');
             });
        }

        else if(Auth::user()->usertype == 3){
            $status = [
                'approval_status' => 'disapproved_by_moderator'
             ];
             $user = DB::table('request_items')->where("id",$id)->pluck('made_by_email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             $beautymail->send('emails.notify', [], function($message) use ($user)
             {
                 $message
                     ->from('bar@example.com')
                     ->to($user[0],$user[0])
                     ->subject('Your Order has been Disapproved By Moderator!');
             });
        }

     DB::table('request_items')->where("id",$id)->update($status);
    return redirect()->back()->with('success','Request No.'. $id .' Disapproved');
    }



    public function updatestatus($id)
    {
        if(Auth::user()->usertype == 2){
            $status = [
                'approval_status' => 'approved_by_hod'
             ];
             $user = DB::table('request_items')->where("id",$id)->pluck('made_by_email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             $beautymail->send('emails.notify', [], function($message) use ($user)
             {
                 $message
                     ->from('bar@example.com')
                     ->to($user[0],$user[0])
                     ->subject('Approved By HOD!');
             });
        }

        else if(Auth::user()->usertype == 3){
            $status = [
                'approval_status' => 'approved_by_moderator'
             ];
             $user = DB::table('request_items')->where("id",$id)->pluck('made_by_email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             $beautymail->send('emails.notify', [], function($message) use ($user)
             {
                 $message
                     ->from('bar@example.com')
                     ->to($user[0],$user[0])
                     ->subject('Approved By Moderator!');
             });
        }

        else if(Auth::user()->usertype == 4){
            $status = [
                'approval_status' => 'fullfilled'
             ];
             $user = DB::table('request_items')->where("id",$id)->pluck('made_by_email')->toArray();
             $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
             $beautymail->send('emails.notify', [], function($message) use ($user)
             {
                 $message
                     ->from('bar@example.com')
                     ->to($user[0],$user[0])
                     ->subject('Your Order has been Fullfilled!');
             });
        }

     DB::table('request_items')->where("id",$id)->update($status);
     if(Auth::user()->usertype == 4){
        return redirect()->back()->with('success','Request No.'. $id .' Fullfilled');
     }
     else{
        return redirect()->back()->with('success','Request No.'. $id .' Approved');
     }
    }
}
