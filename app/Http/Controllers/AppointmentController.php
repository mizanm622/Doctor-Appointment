<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\Check;

class AppointmentController extends Controller
{
    //
    public function index(){

          $department = Department::all();


        return view('appointment.index', compact('department'));
    }

    public function sessionForm(Request $request){


            $sessionData = array(
                'appointment_date' => $request->appointment_date,
                'department_id' => $request->department_id,
                'name'=>$request->name,
                'fee'=>$request->fee,
            );

           $data = Session::push('data',  $sessionData);

            return redirect()->back()->with('data', $data);



        }




}



