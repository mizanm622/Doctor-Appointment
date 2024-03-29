<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //shoe home page
    public function index(){

        $appointmonts = Appointment::latest()->orderBy('id','DESC')->paginate(5);
        return view('main', compact('appointmonts'));
    }

    // search appointment
    public function appointmentSearch(Request $request){

        $appointmonts = Appointment::where('appointment_date','like', '%'.$request->search_string.'%')
        ->orWhere('patient_name','like', '%'.$request->search_string.'%')
        ->orWhere('patient_phone','like', '%'.$request->search_string.'%')
        ->orderBy('id','desc')->paginate(5);

        if($appointmonts->count() >= 1){
            return view('search', compact('appointmonts'))->render();
        }else{
            return response()->json(['status'=>'No data found!']);
        }
    }
}
