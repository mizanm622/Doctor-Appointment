<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //view doctor and department
    public function index(){

        $department = Department::all();
        $doctors = Doctor::latest()->get();
        return view('doctor.index',compact('department','doctors'));
    }

    // store new doctor
    public function store(Request $request){

        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required',
            'fee'=>'required',
        ]);

        Doctor::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'fee'=>$request->fee,
            'department_id'=>$request->department_id,
        ]);

        return response()->json('Doctor successfully inserted');
    }

    // edit doctor function
    public function edit($id){
        $doctor = Doctor::find($id);
        $department = Department::all();
        return view('doctor.edit', compact('doctor','department'))->render();
    }

    // update doctor function
    public function update(Request $request){
        $request->validate([
            'name'=>'required|max:255',
            'phone'=>'required',
            'fee'=>'required',
        ]);

        Doctor::where('id',$request->id)->update([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'fee'=>$request->fee,
            'department_id'=>$request->department_id,
        ]);

        return response()->json('Doctor successfully updated');
    }

    // delete doctor function
    public function delete($id){
        Doctor::where('id', $id)->delete();
        return response()->json('Doctor successfully deleted');
    }

    // get doctor
    public function getDoctor($id){
        $data=Doctor::where('department_id',$id)->get();
        return response()->json($data);
    }

    public function getDoctorFee(Request $request){

        $dateCount =Appointment::where('appointment_date',$request->appointment_date)->where('doctor_id', $request->id)->get()->count();
        // check appointment date is available or not
        if( $dateCount >= 2){
                 return response()->json($dateCount);
            }else{
                $data = Doctor::where('id',$request->id)->get();
                return response()->json($data);
            }
    }


}
