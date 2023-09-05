<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    // retrive department to appointment form
    public function index(){

          $department = Department::all();
          return view('appointment.index', compact('department'));
    }

    // store appointment
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
           'patient_name'=>'required',
          'patient_phone'=>'required',
              'total_fee'=>'required',
            'paid_amount'=>'required',
              'total_fee'=> 'same:paid_amount',
      ]);

      if ($validator->fails()) {
         return response()->json('Your data is not match the requirments. Please check before submit');
      }

        $cart = session()->get('cart');
        if(isset( $cart)){
        foreach (Session::get('cart') as  $row){
        Appointment::insert([
            'patient_name'=>$request->patient_name,
            'patient_phone'=>$request->patient_phone,
            'total_fee'=>$request->total_fee,
            'paid_amount'=>$request->paid_amount,
            'appointment_date'=>$row['appointment_date'],
            'doctor_id'=>$row['doctor_id'],
            'appointment_no'=>$row['appointment_no'],
        ]);
        }
        session()->flush();
        return response()->json('Appointment Successfully Inserted');
        }
        else{
        return response()->json('Please Add Atleast One Doctor');
        }

    }

    // appointment delete
    public function destroy(Request $request){

        Appointment::where('id', $request->id)->delete();
        return response()->json('Appointment Successfully Delete');
    }

     // add appointment session
    public function sessionForm(Request $request){

        $dateCount =Appointment::where('appointment_date',$request->appointment_date)->where('doctor_id', $request->id)->get()->count();
        // check appointment date is available or not
        if( $dateCount >= 2){
                 return response()->json('The Doctor is not available. Please try another...');
            }
            else{
        $doctorName = Doctor::where('id',$request->id)->first();
        $cart = session()->get('cart');
        if(!$cart){
            $cart = [
                $request->id => [
                'appointment_no' => $request->appointment_no,
                'appointment_date' => $request->appointment_date,
                'department_id' => $request->department_id,
                'doctor_id' => $request->id,
                'name'=>$doctorName->name,
                'fee'=>$doctorName->fee,
                ]
            ];
            session()->put('cart',  $cart);
            return response()->json('Appointment Successfully Added!');
            }

        if(isset($cart[$request->id])){
            return response()->json('Already  Added!');
        }
            $cart[$request->id] =[
                'appointment_no' => $request->appointment_no,
                'appointment_date' => $request->appointment_date,
                'department_id' => $request->department_id,
                'doctor_id' => $request->id,
                'name'=>$doctorName->name,
                'fee'=>$doctorName->fee,
            ];

        }


          session()->put('cart',  $cart);
          return response()->json('Appointment Successfully Added!');

        }

        // remove appointment session
        public function sessionRemove(Request $request){

            $cart = session()->get('cart');
              if (isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                  session()->put('cart', $cart);
                 }

                return response()->json('Appointmet Successfully Removed!');
        }


}



