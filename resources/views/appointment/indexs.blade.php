@extends('home')

@section('main-content')

<div class="container-fluid">
    <div class="row">
        <div class="col-5">
            <div class="appointment-form bg-light my-3">
                <div class="card">
                    <div class="card-body ">
                        <form action="{{route('appointment.session')}}" method="post" id="add-session">
                            @csrf
                            @php
                            $rand= rand();
                            @endphp

                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput">Appoinrment Date</label>
                                <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="appointment_date" id="appointment_date" required>
                                <input type="hidden" name="appointment_no" value="{{$rand}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput2">Select Department</label>
                               <select class="form-control" name="department_id" id="department_id">
                                <option value="">--Select Option--</option>
                                @foreach($department as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                               </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput2">Select Doctor</label>
                               <select class="form-control" name="id" id="id">
                                <option value="">--Select Option--</option>
                               </select>
                               <span class="available text-success"></span>
                               <span class="not-available text-danger"></span>
                            </div>
                            <div class="form-group mb-3">
                                <label for="formGroupExampleInput2">Fee</label>
                               <select class="form-control" name="fee" id="fee" required>

                               </select>

                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" value="Add" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                  </div>

            </div>
        </div>

        <div class="col-7">
            <div class="form-container bg-secondary">
            <div class="appointment-form">
                <table class="table table-border">
                        <thead class="text-light">
                        <tr class="p-0">
                            <th class="w-0" scope="col">SN</th>
                            <th scope="col">App.Date</th>
                            <th scope="col">Doctor</th>
                            <th scope="col">Fee</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="text-light">
                            @php
                            $total = 0;
                            @endphp
                            @if(session()->has('cart'))
                            @foreach (Session::get('cart') as $id => $row)

                            @php
                                $total+=$row['fee'];
                            @endphp
                            <tr class="p-0">
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$row['appointment_date']}}</td>
                            <td>{{$row['name']}}</td>
                            <td>{{$row['fee']}}</td>
                            <td> <a href="javascript:void(0)" data-id="{{$id}}" id="delete" class="btn btn-danger btn-sm">Delete</a></td>
                            </tr>

                             @endforeach
                             @endif
                             <tr>
                                @if($total != 0 )
                                <td colspan="5"> Total ={{$total}} /-</td>
                                @else
                                <td colspan="5" class="text-center text-warning"> Please add an appointment!</td>
                                @endif
                             </tr>
                    </tbody>
                </table>
            </div>
                <div class="patient-info-form pt-5  px-5 mt-5">
                    <div class="card">
                        <div class="card-body bg-light">
                            <form action="{{route('appointment.store')}}" method="post" id="appointment-form">
                                @csrf
                                <div class="row mt-5">
                                    <div class="form-group col-6">
                                        <label for="patient_name" class="form-label text-md-end">{{ __('Patient Name') }}</label>
                                        <input id="patient_name" type="text" class="form-control @error('patient_name') is-invalid @enderror" name="patient_name" required placeholder="Patient-Name">
                                        @error('patient_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-2 mb-3 col-6">
                                        <label for="patient_phone" class="form-label text-md-end">{{ __('') }}</label>
                                        <input id="patient_phone" type="text" class="form-control" name="patient_phone" required placeholder="Patient-Phone">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="total_fee" class="form-label text-md-end">{{ __('Total Fee') }}</label>
                                        <input id="total_fee" type="text" value="{{$total}}" class="form-control  @error('total_fee') is-invalid @enderror" name="total_fee" required placeholder="Total-Fee">

                                        @error('total_fee')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-2 mb-3 col-6">
                                        <label for="paid_amount" class="form-label text-md-end">{{ __('') }}</label>
                                        <input id="paid_amount" type="text" class="form-control" name="paid_amount" required placeholder="Paid-Amount">
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
    let id=$(this).val();

    $.ajax({
        url: '/doctor/get/'+id,
        type: 'get',
        dataType: 'json',
        success:function(data){
            $('select[name=id]').empty();
            $.each(data, function(key, data){
                $('select[name=id]').append('<option value="' +data.id+ '">' +data.name+ '</option>');
            });
        }
    });
 });

    // get fee
    $(document).on('change', '#id' ,function(){

    let id=$(this).val();
    let appointment_date=$('#appointment_date').val();
    $('.status-show').text('');
    $("#fee").val('');

    $.ajax({
        url: '/fee/get/'+id,
        type: 'get',
        dataType: 'json',
        data: {
            appointment_date : appointment_date,
        },
        success:function(data){
                if(data >= 2) {
                $('.not-available').text('Not Available');
                }
                else {
                $('.available').text('Available');
                $('select[name=fee]').empty();
                $.each(data, function(key, data){
                $('select[name=fee]').append('<option value="'+data.id+'">'+data.fee+'</option>');
                });
              }


        }
    });
    });




    // delete session
  $(document).on('click','#delete', function(){
      let id=$(this).data('id');
      $.get('/remove/session/'+id, function(data){
          toastr.success(data);
          $('.table').load(location.href+' .table');
          $('#appointment-form').load(location.href+' #appointment-form');
      });
      })



// insert appointment data
$(document).ready(function() {

 $('#appointment-form').submit(function(e) {

    e.preventDefault();
    let url = $(this).attr('action');
    let request = $(this).serialize();
    alert();
    $.ajax({
        url: url,
        type: 'post',
        anyne: false,
        data: request,
        success:function(data) {
            toastr.success(data);
             $('#appointment-form')[0].reset();
             $('.table').load(location.href+' .table');
        }
    });
    });
});

// insert session data
$(document).ready(function() {

$('#add-session').submit(function(e) {

   e.preventDefault();
   let url = $(this).attr('action');
   let request = $(this).serialize();

   $.ajax({
       url: url,
       type: 'post',
       anyne: false,
       data: request,
       success:function(data) {
           toastr.success(data);
            $('#add-session')[0].reset();
            $('.table').load(location.href+' .table');
            $('#appointment-form').load(location.href+' #appointment-form');
       }
   });
   });
});



  </script>



@endsection
