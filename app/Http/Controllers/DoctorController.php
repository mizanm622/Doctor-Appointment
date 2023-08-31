<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(){

        $department = Department::all();
        $doctors = Doctor::latest()->get();
        return view('doctor.index',compact('department','doctors'));
    }

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

        return response()->json('Doctor successfully insert');
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

        $data = Doctor::where('id',$request->id)->get();
        $dateCount = Appointment::where('id',$request->id)->where('appointment_date', $request->app_date)->count();

        return response()->json($data);
    }




}
