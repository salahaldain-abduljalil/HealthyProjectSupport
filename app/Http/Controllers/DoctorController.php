<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function AllDoctor()
    {
        $users = User::where('role', 'psychologist')->get();
        return view('Doctors.alldoctors', compact('users'));
    }

    public function createDoctor(Request $request)
    {

        $user = new User();
        $user->user_name = $request->user_name;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'psychologist';
        $user->status = '1';
        $user->save();

        $notification = array(
            'message' => 'تم إنشاء الطبيب بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.doctors')->with($notification);
    }

    public function updateDoctor(Request $request)
    {

        $id = $request->id;

        User::find($id)->update([
            'id'      => $request->id,
            'user_name' => $request->user_name,
            'name'  => $request->name,
            'password' =>   Hash::make($request->password),
            'phone'    => $request->phone,
            'address' => $request->address,
            'role'   => 'psychologist',
            'status' => '1'
        ]);

        $notification = array(
            'message' => 'تم تعديل الطبيب بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.doctors')->with($notification);
    }

    public function deleteDoctor($id)
    {

        User::where('id', $id)->delete();

        $notification = array(
            'message' => 'تم حذف الطبيب بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('all.doctors')->with($notification);
    }

    public function get()
    {
        $appointments = Appointment::where('doctor_id', Auth::user()->id)->get();
        return view('Doctors.allappointments', compact('appointments'));
    }

    public function create(Request $request)
    {

        Appointment::create([
            'dateofwork' => $request->dateofwork,
            'day'  => $request->day,
            'attendancetime'  => $request->attendancetime,
            'departuretime'   => $request->departuretime,
            'doctor_id'      => $request->doctor_id,
        ]);

        $notification = array(
            'message' => 'تم إنشاء موعدك بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('get.appointments')->with($notification);
    }

    public function update(Request $request)
    {

        Appointment::whereId($request->id)->update([

            'id' => $request->id,
            'dateofwork' => $request->dateofwork,
            'day'  => $request->day,
            'attendancetime'  => $request->attendancetime,
            'departuretime'   => $request->departuretime,
            'doctor_id'      => $request->doctor_id,
        ]);


        $notification = array(
            'message' => 'تم تعديل موعدك بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('get.appointments')->with($notification);
    }

    public function Delete($id){

        Appointment::where('id', $id)->delete();

        $notification = array(
            'message' => 'تم حذف الموعد بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('get.appointments')->with($notification);
    }
}
