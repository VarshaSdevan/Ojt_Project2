<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
            <meta charset=utf-8>
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <!---Fontawesome--->
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
            <!---Bootstrap5----->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
            <!---custom style---->
            <link rel="stylesheet" href="../css/styl.css">
    </head>
    <style>
      
    </style>
<body>
<!-- main section start -->
<section>
  <div class="row">
    <div class="col-2">
    </div>
    <div class="col-8">
<h3 class="text-dark h2 text-center">REGISTRATION</h3>
<form action="<?php echo base_url()?>main/reginsert" method="POST" class="border  border-2 border-light p-5 rounded-bottom rounded bg-info">

  <div class="row">
    <div class="col-10 mb-3">
      <input type="text" class="form-control" placeholder="First name" name="fname" required maxlength="25" pattern="[a-zA-Z]+" >
       
    </div>
  </div>
  
  <div class="row">
      <div class="col-10 mb-3">
            <input type="text" class="form-control" placeholder="Last name" name="lname"required maxlength="25" pattern="[a-zA-Z]+" >
          </div>
        </div>
        <div class="row mb-3">
    <div class="col-10">
      <input type="email" class="form-control" id="email" placeholder="email" name="email" required ><span id="email_result"></span>
    </div>
    </div>
    <div class="row mb-3">
    <div class="col-10">
      <input type="text" class="form-control" id="mobile" placeholder="Mobile number" name="mobile" required pattern="[6-9]{1}[0-9]{9}">  <span id="mobile_result"></span>
    </div>
  </div>
        <div class="row mb-3">
    <div class="col-10">
     <textarea placeholder="Address" class="form-control" name="address"></textarea>
    </div>
  </div>
  <div class="row mb-3">
       <div class="col-10">
        <input list="district"  class="form-control" name="district" placeholder="District">
          <datalist id="district">
            <option value="Thiruvanathapuram">
                <option value="Kollam">
                <option value="Pathanamthitta">
                <option value="Alappuzha">
                <option value="Kottayam">
                <option value="Idukki">
                <option value="Eranakulam">
                <option value="Thrissur">
            </datalist>

     </div>
   </div>
   <div class="row ">
    <div class="col-10">
        <input type="text"  class="form-control" name="pin"  placeholder="Pincode"></br>
      
    </div>
  </div>

<div class="row mb-3">
  <div class="col-10">
    <h6>Date of Birth:</h6>
         <input type="date"   class="form-control" name="dob"  placeholder="Date of birth">
  </div>
</div>
<div class="row mb-3">
  <div class="col-10">
         <input type="text"  class="form-control" id="username" name="username"  placeholder="User name">
          <span id="username_result"></span>
  </div>
</div>
  
  <div class="row mb-3">
    <div class="col-10">
      <input type="password" class="form-control" placeholder="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" >
    </div>
  </div>
  <input type="submit" name="submit" class="btn btn-warning" value="sign-up">

  <a href="<?php echo base_url()?>main/index">Sign-In</a>
 
  </form>
 
</div>

<div class="col-2">
</div>
</section>
<!-- main section end -->


<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
<script>
  $(document).ready(function(){  
      $('#email').change(function(){  
           var email = $('#email').val();  
           if(email != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main/check_email_avalibility",  
                     method:"POST",  
                     data:{email:email},  
                     success:function(data){  
                          $('#email_result').html(data);  
                     }  
                });  
           }  
      });  
 });  
  $(document).ready(function(){  
      $('#mobile').change(function(){  
           var mobile = $('#mobile').val();  
           if(mobile != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main/check_mobile_avalibility",  
                     method:"POST",  
                     data:{mobile:mobile},  
                     success:function(data){  
                          $('#mobile_result').html(data);  
                     }  
                });  
           }  
      });  
 });  
    $(document).ready(function(){  
      $('#username').change(function(){  
           var username = $('#username').val();  
           if(username != '')  
           {  
                $.ajax({  
                     url:"<?php echo base_url(); ?>main/check_username_avalibility",  
                     method:"POST",  
                     data:{username:username},  
                     success:function(data){  
                          $('#username_result').html(data);  
                     }  
                });  
           }  
      });  
 });  
</script>
</body>
</html>