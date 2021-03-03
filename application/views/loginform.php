<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
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
	<div class="row">
    <div class="col-2">
    </div>
     <div class="col-8 py-5">
     	<h3 class="text-dark h2 text-center">LOGIN</h3>
		<form method="post" action="<?php echo base_url()?>main/login" class="border  border-2 border-light p-5 rounded-bottom rounded bg-info">
			<div class="row">
           <div class="col-10 mb-3">
         <input type="text" class="form-control" placeholder="Email/Mobile/Username" name="email">
     </div>
 </div> 
 <div class="row mb-3">
    <div class="col-10">
      <input type="password" class="form-control" placeholder="password" name="password">
    </div>
  </div>
   <input type="submit" name="submit" class="btn btn-warning" value="Login">
   </br>
       <a href="<?php echo base_url()?>main/forgotpswd" class="my-5">Forgot password?</a>
 </form>
 <div class="col-2">
 </div>
	</div>
    
	<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
	</body>	
</html>  