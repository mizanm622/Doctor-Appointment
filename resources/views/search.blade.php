
@foreach($appointmonts as $row)
    <tr class="table-row">
        <th scope="row">{{$loop->iteration}}</th>
        <td> {{substr($row->appointment_date, 0, 10) }}</td>
        <td>{{$row->doctor->name}}</td>
        <td>{{$row->doctor->fee}}</td>
        <td>{{$row->patient_name}}</td>
        <td>{{$row->patient_phone}}</td>
        <td>{{$row->paid_amount}}</td>
        <td><a href="javascript:void(0)" data-id="{{$row->id}}" id="delete" class="btn btn-danger btn-sm">Delete</a></td>
    </tr>
@endforeach

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">

   // delete session
   $(document).on('click','#delete', function(){
      let id=$(this).data('id');
      $.get('/appointment/destroy/'+id, function(data){
          toastr.success(data);
          $('.table-data').load(location.href+' .table-data');

      });
      })

</script>

