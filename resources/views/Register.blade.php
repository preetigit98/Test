
<!-- HTML Form (wrapped in a .bootstrap-iso div) -->

@include('header')
<div class="bootstrap-iso">
 <div class="container-fluid">
 <div class="row">
    <h2>Register Form</h2>

   
 </div>
 
 <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form method="post"  action=""  id="register"  >
      @csrf
     <div class="form-group ">
      <label class="control-label " for="name">
       FirstName
      </label>
      <input class="form-control" required id="name" name="name" placeholder="FirstName" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label " for="lastname">
       LastName
      </label>
      <input class="form-control"  required id="lastname" name="lastname" placeholder="LastName" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="email">
       Email
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control"  required  id="email" name="email"  placeholder="Email"   type="Email"  onkeyup="emailexits(this.value);"  />
      <label  id="exited" ></label>
    </div>
     <div class="form-group">
      <div>
       <button class="btn btn-primary " name="submit" type="submit" id="submit">
        Submit
       </button>
      </div>
     </div>
    </form>

  
   </div>
  </div>
 </div>


 <div class="container mt-5">
    <h2 class="mb-4">Users Data</h2>
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>LastName</th>
                <th>Email</th>
              
                <th>profile<th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

$( document ).ready(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
});


  function emailexits(value){
  
    $.ajax({
      type: "POST",
      url: "{{route('checkemailexits')}}",
      data : {email:value},
      success:function(data){
        console.log(data);
        if(data.status == 'failed'){
          console.log('failed');
          $(':input[type="submit"]').prop('disabled', true);
          $("#exited").text(data.message);

        } else{
          $(':input[type="submit"]').prop('disabled', false);
          $("#exited").text(data.message);

        }
      }

    });
    
  }


  $("#register").submit(function () {
     event.preventDefault();
    $.ajax({
      type: "POST",
      url: "{{route('Registerstore')}}",
      data :  $("#register").serialize(),
      success:function(data){
        console.log(data);
        if(data.status == 'success'){
          swal("Thank You", "For Registration", "success");
          location.reload();

        } else{
          swal("OOpps","Something went wrong","failed");
        }
      }

    });

  });

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('home') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name',orderable: true,searchable: true},
            {data: 'lastname', name: 'lastname',orderable: true,searchable: true},
            {data: 'email', name: 'email',orderable: true,searchable: true},
            {data: 'profile', name: 'profile',orderable: true,searchable: true},
            
        ]
    });
    
  });
</script>