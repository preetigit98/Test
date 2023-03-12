
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}"><!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
 <div class="row">
    <h2> {{$heading}}</h2>
 </div>
 
 <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form method="post"  action=""  id="editusers"  >

    <input class="form-control" value={{$userdata->id}}  required id="id" name="id"  type="hidden"/>
   

     <div class="form-group ">
      <label class="control-label " for="name">
       FirstName
      </label>
      <input class="form-control" value={{$userdata->name}}  required id="name" name="name" placeholder="FirstName" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label " for="lastname">
       LastName
      </label>
      <input class="form-control"  value={{$userdata->lastname}}   required id="lastname" name="lastname" placeholder="LastName" type="text"/>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="email">
       Email
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control"   readonly   value={{$userdata->email}} name="email"  placeholder="Email"   type="Email"  onkeyup="emailexits(this.value);"  />
      <label  id="exited" ></label>
    </div>

    <div class="form-group ">
      <label class="control-label requiredField" for="email">
      Profile Picture
      
      </label>
     <img src="{{asset('public/profile/'.$userdata->profile)}}"   width="100" height="100"  >
          <label  id="exited" ></label>
    </div>

     <div class="form-group">
      <div>
       <button class="btn btn-primary " name="submit" type="submit" id="submit">
        Save
       </button>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>



  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  
  $("#editusers").submit(function () {
     event.preventDefault();
    $.ajax({
      type: "POST",
      url: "{{route('editDetails')}}",
      data :  $("#editusers").serialize(),
      success:function(data){
        console.log(data);
        if(data.status == 'success'){
          swal("Thank You", data.message, "success");
          location.reload();

        } else{
          swal("OOpps","Something went wrong","failed");
        }
      }

    });

  });

</script>