@extends('home')


@section('main-content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="appointment-form bg-light my-3">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insertModal">
                           + Add New
                        </button>
                    </div>
                    <div class="card-body ">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">SN</th>
                                <th scope="col">Doctor Name</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col">Department</th>
                                <th scope="col">Fee</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $row)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->department->name}}</td>
                                    <td>{{$row->fee}}</td>
                                    <td><a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#updateModal" data-id="{{$row->id}}" id="edit">Edit</a> <a href="javascript:void(0)"  class="btn btn-danger" data-id="{{$row->id}}" id="delete">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Insert Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Doctor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body ">
                    <form action="{{route('doctor.store')}}" method="POST" id="add-form">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="formGroupExampleInput">Doctor Name</label>
                            <input type="text" class="form-control" name="name" id="appointment_date" placeholder="Enter doctor name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="formGroupExampleInput">Phone No.</label>
                            <input type="text" class="form-control" name="phone" id="appointment_date" placeholder="Enter doctor Phone number" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="formGroupExampleInput">Fee</label>
                            <input type="text" class="form-control" name="fee" id="appointment_date" placeholder="Enter doctor fee" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="formGroupExampleInput">Department</label>
                            <select class="form-control" name="department_id" id="department_id">
                                @foreach ($department as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                               </select>
                        </div>

                        <div class="form-group mb-3">
                            <input type="submit" value="Submit" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

  <!--Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add New Doctor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal_body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script type="text/javascript">

// edit data
$(document).on('click','#edit',function(){
      let id=$(this).data('id');
      $.get('/doctor/edit/'+id, function(data){
          $('.modal_body').html(data);
      });
      })

// delete data
$(document).on('click','#delete', function(){
      let id=$(this).data('id');
      $.get('/doctor/delete/'+id, function(data){
          toastr.success(data);
          $('.table').load(location.href+' .table');
      });
      })


</script>

<script type="text/javascript">

// insert doctor data
$(document).ready(function() {

 $('#add-form').submit(function(e) {

    e.preventDefault();
    var url = $(this).attr('action');
    var request = $(this).serialize();

    $.ajax({
        url: url,
        type: 'post',
        anyne: false,
        data: request,
        success:function(data) {
            toastr.success(data);
             $('#add-form')[0].reset();
             $(document).find('#insertModal .close').trigger('click');
             $('.table').load(location.href+' .table');
        }
    });
    });
});

  </script>


