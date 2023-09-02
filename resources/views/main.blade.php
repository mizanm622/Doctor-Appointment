@extends('home')

@section('main-content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">

                        <input type="search" class="form-control" name="search" id="search" placeholder=" Search doctor/appointment">

                    <div class="table-data">
                        <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">SN</th>
                            <th scope="col">App. Date</th>
                            <th scope="col">Doctor</th>
                            <th scope="col">Doc. Fee</th>
                            <th scope="col">P. Name</th>
                            <th scope="col">P. Phone</th>
                            <th scope="col">Pain Amount</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody class="tbody">
                          @include('search')
                        </tbody>
                      </table>

                    </div>
                    {!! $appointmonts->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
 // get child category to select subcategory using ajax request

 $(document).on('keyup',function(e){
    e.preventDefault();
    let search_string = $('#search').val();
    $.ajax({
    url: '/appointment/search',
    type: 'get',
    data: {
        search_string : search_string
    },
    success:function(res){

        $('.table-data tbody').html(res);
    }

    });

 });



</script>
@endsection
