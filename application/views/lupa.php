<!DOCTYPE html>   
<html>   
<head>   
 <meta charset="UTF-8">   
 <title>   
 </title>   
</head>   
<body>   
 <h2>Lupa Password</h2>   
 <p>Untuk melakukan reset password, silakan masukkan alamat email anda. </p>   
 <?php echo form_open('home/Lupa');?>   
 <p>Email:</p>   
 <p>   
   <input type="text" name="email" value="<?php echo set_value('email'); ?>"/>   
 </p>   
 <p> <?php echo form_error('email'); ?> </p>   
 <p>   
   <input type="submit" name="btnSubmit" value="Submit" />   
 </p>   
</body>   
</html>   