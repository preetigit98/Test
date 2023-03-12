
 @include('header')
<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
 <div class="container-fluid">
 <div class="row">
    <h2>Login Form</h2>
 </div>
 
 <div class="row">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <form method="post"  action=""  id="login"  >
     <div class="form-group ">
      <label class="control-label requiredField" for="email">
       Email
       <span class="asteriskField">
        *
       </span>
      </label>
      <input class="form-control"  required  id="email" name="email"  placeholder="Email"   type="Email" />
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

    <div class="form-group " id="qrsection"   style="display:none" >
      <label class="control-label requiredField" for="email">
            Please Scan Qr Code To get Details
     
      </label>

      <img src="" id="qrcodeimg"  >
      <label  id="exited" ></label>
    </div>
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
  

  $("#login").submit(function () {
     event.preventDefault();
    $.ajax({
      type: "POST",
      url: "{{route('loginpost')}}",
      data :  $("#login").serialize(),
      success:function(data){
        console.log(data);
        if(data.status == 'success'){
           $("#qrsection").show();
            $('#qrcodeimg').attr('src',data.dataimage);
        } else{
          swal("OOpps","Something went wrong","failed");
        }
      }

    });

  });
  

// https://qrcodescan.in/ to scan the qrcode 
</script>