<?php

namespace App\Http\Controllers;

use App\Models\Sudentreservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function get(){
       $users = User::where('role','student')->get();
       foreach($users as $user){
        $allreservations = Sudentreservation::where('user_id',$user->id)->get();
       }
        return view('student.allreservation',compact('allreservations'));
    }
    public function Create(Request $request){

        $user = User::where('id',$request->doctor_name)->first();

        Sudentreservation::create([
            'name' => $request->name,
            'email'  => $request->email,
            'address'  => $request->address,
            'phone'   => $request->phone,
            'doctor_name'      => $user->name,
            'doctor_date'      => $request->doctor_date,
            'user_id'      => $request->user_id,
            'user_name'      => $request->user_name,
            'description'      => $request->description,
        ]);

        $notification = array(
            'message' => 'تم إنشاء حجزك بنجاح يرجى متابعة موعدك',
            'alert-type' => 'success'
        );

        return redirect()->route('get.reservations')->with($notification);

    }
}
