<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // home page
    public function index(){
        $appointmonts = Appointment::latest()->orderBy('id','DESC')->paginate(3);

        return view('main', compact('appointmonts'));
    }

    // search appointment

    public function appointmentSearch(Request $request){

        // $appointmonts = DB ::table('appointments')
        //     ->leftJoin('doctors', 'appointments.doctor_id','doctors.id')
        //     ->where('doctors.name','like', '%'.$request->search_string.'%')
        //     ->orWhere('patient_name','like', '%'.$request->search_string.'%')
        //     ->orderBy('id','desc')->paginate(3);


        $appointmonts = Appointment::where('appointment_date','like', '%'.$request->search_string.'%')
        ->orWhere('patient_name','like', '%'.$request->search_string.'%')
        ->orderBy('id','desc')->paginate(3);

        if($appointmonts-> count() >= 1){
            return view('search', compact('appointmonts'))->render();
        }else{
            return response()->json(['status'=>'No data found!']);
        }
    }
}
