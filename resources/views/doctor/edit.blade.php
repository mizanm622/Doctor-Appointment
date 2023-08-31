<div class="modal-body">
    <div class="card">
        <div class="card-body ">
            <form action="{{route('doctor.update')}}" method="POST" id="update-form">
                @csrf
                <div class="form-group mb-3">
                    <label for="formGroupExampleInput">Doctor Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$doctor->name}}" required>
                    <input type="hidden" name="id" value="{{$doctor->id}}">
                </div>
                <div class="form-group mb-3">
                    <label for="formGroupExampleInput">Phone No.</label>
                    <input type="text" class="form-control" name="phone" id="appointment_date" value="{{$doctor->phone}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="formGroupExampleInput">Fee</label>
                    <input type="text" class="form-control" name="fee" id="appointment_date" value="{{$doctor->fee}}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="formGroupExampleInput">Department</label>
                    <select class="form-control" name="department_id" id="department_id">
                        @foreach ($department as $item)
                        <option value="{{$item->id}}" @if($item->id == $doctor->department_id) selected="" @endif>{{$item->name}}</option>
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

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    // insert review data

    $(document).ready(function() {

     $('#update-form').submit(function(e) {

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
                 $('#update-form')[0].reset();
                 $(document).find('#updateModal .btn-close').trigger('click');
                 $('.table').load(location.href+' .table');
            }
        });
        });
    });

      </script>
