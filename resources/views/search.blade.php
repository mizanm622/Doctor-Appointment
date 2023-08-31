
@foreach($appointmonts as $row)
    <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td> {{substr($row->appointment_date, 0, 10) }}</td>
        <td>{{$row->doctor->name}}</td>
        <td>{{$row->doctor->fee}}</td>
        <td>{{$row->patient_name}}</td>
        <td>{{$row->patient_phone}}</td>
        <td>{{$row->total_fee}}</td>
        <td><a href="" class="btn btn-info">Edit</a> <a href="" class="btn btn-danger">Delete</a></td>
    </tr>
@endforeach
