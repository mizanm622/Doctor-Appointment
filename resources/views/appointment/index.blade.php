@extends('home')

@section('main-content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="appointment-form bg-light my-3">
                <div class="card">
                    <div class="card-body ">
                        <form action="{{route('appointment.session')}}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput">Appoinrment Date</label>
                                <input type="date" class="form-control" name="appointment_date" id="appointment_date" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput2">Select Department</label>
                               <select class="form-control" name="department_id" id="department_id">
                                @foreach($department as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                               </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput2">Select Doctor</label>
                               <select class="form-control" name="name" id="name">

                               </select>
                               {{-- @if(json_decode($data, true))
                               <h4>Not Available</h4>
                               @else
                               <h4>Available</h4>
                               @endif --}}


                            </div>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput2">Select Fee</label>
                               <select class="form-control" name="fee" id="fee">

                               </select>
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" value="Submit" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                  </div>

            </div>
        </div>


        <div class="col-6">
            <div class="appointment-form bg-secondary my-3">
                <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">App. Date</th>
                            <th scope="col">Doctor</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(session()->has('data'))
                            @foreach (Session::get('data') as $row)

                        <tr>
                            <th scope="row">1</th>
                            <td>{{$row->appointment_date}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->fee}}</td>
                            <td><a href="" class="btn btn-info">Edit</a> <a href="" class="btn btn-danger">Delete</a></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="patient-info-form px-5 my-4">
                    <div class="card">
                        <div class="card-body bg-light">
                            <form action="" method="post">
                                <div class="row">

                                    <div class="form-group mb-3 col-6">
                                        <label for="formGroupExampleInput">Patient Name</label>
                                        <input type="text" class="form-control" name="appointment_date" id="appointment_date" required>
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label for="formGroupExampleInput"></label>
                                        <input type="text" class="form-control" name="appointment_date" id="appointment_date" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-6">
                                        <label for="formGroupExampleInput">Appoinrment Date</label>
                                        <input type="text" class="form-control" name="appointment_date" id="appointment_date" required>
                                    </div>
                                    <div class="form-group mb-3 col-6">
                                        <label for="formGroupExampleInput"></label>
                                        <input type="text" class="form-control" name="appointment_date" id="appointment_date" required>
                                    </div>
                                </div>

                                    <div class="form-group mb-3">
                                        <input type="submit" value="Submit" class="btn btn-primary btn-block">
                                    </div>



                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
 // get child category to select subcategory using ajax request

 $(document).on('change', '#department_id' ,function(){

    var id=$(this).val();

    $.ajax({
        url: '/doctor/get/'+id,
        type: 'get',
        dataType: 'json',
        success:function(data){
            $('select[name=name]').empty();
            $.each(data, function(key, data){
                $('select[name=name]').append('<option value="'+data.id+'">'+data.name+'</option>');

            });
        }
    });
 });


 $(document).on('change', '#name' ,function(){

var id=$(this).val();
var app_date=$('#appointment_date').val()

$.ajax({
    url: '/fee/get/',
    type: 'get',
    dataType: 'json',
    data: {
        id : id,
        app_date : app_date
    },
    success:function(data){
        $('select[name=fee]').empty();
        $.each(data, function(key, data){
            $('select[name=fee]').append('<option value="'+data.id+'">'+data.fee+'</option>');
        });
    }
});
});


</script>
@endsection
