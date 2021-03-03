<!DOCTYPE html>
<html>
    <head>
        <title>Updation</title>
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
<h3 class="text-dark h2 text-center">Updation</h3>
<form action="<?php echo base_url()?>main/updateaction" method="POST" class="border  border-2 border-light p-5 rounded-bottom rounded bg-info">
  <?php
        if(isset($user_data))
        {
            foreach($user_data->result() as $row1) 
            {
                ?>
  <div class="row">
    <div class="col-10 mb-3">
      <input type="text" class="form-control" value="<?php echo $row1->fname;?>" name="fname" required maxlength="25" pattern="[a-zA-Z]+" >
       
    </div>
  </div>
  
  <div class="row">
      <div class="col-10 mb-3">
            <input type="text" class="form-control" value="<?php echo $row1->lname;?>" name="lname"required maxlength="25" pattern="[a-zA-Z]+" >
          </div>
        </div>
        <div class="row mb-3">
    <div class="col-10">
      <input type="email" class="form-control" id="email" value="<?php echo $row1->email;?>" name="email" required >
    </div>
    </div>
    <div class="row mb-3">
    <div class="col-10">
      <input type="text" class="form-control" value="<?php echo $row1->mobile;?>" name="mobile" required pattern="[6-9]{1}[0-9]{9}">
    </div>
  </div>
        <div class="row mb-3">
    <div class="col-10">
     <textarea  class="form-control" name="address"><?php echo $row1->address;?></textarea>
    </div>
  </div>
  <div class="row mb-3">
       <div class="col-10">
        <input list="district"  class="form-control" name="district" value="<?php echo $row1->district;?>">
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
        <input type="text"  class="form-control" name="pin" value="<?php echo $row1->pin;?>" ></br>
      
    </div>
  </div>

<div class="row mb-3">
  <div class="col-10">
    <h6>Date of Birth:</h6>
         <input type="date"   class="form-control" name="dob"  value="<?php echo $row1->dob;?>">
  </div>
</div>
<div class="row mb-3">
  <div class="col-10">
         <input type="text"  class="form-control" name="username"  value="<?php echo $row1->username;?>">
  </div>
</div>
 
<div class="row mb-3">
  <div class="col-10">
  <input type="hidden" name="id" value="<?php echo $row1->id;?>">
  <input type="submit" name="update" class="btn btn-warning"  value="Update">
</div>
</div>
 </div>
<?php
            }         
             }
             ?>
 
  </form>
 
</div>

<div class="col-2">
</div>
</section>
<!-- main section end -->


<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
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
</script>
</body>
</html>