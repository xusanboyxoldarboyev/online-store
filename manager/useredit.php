<!DOCTYPE html >
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=divice-width, initial-scale=1.0">
        <title>Document</title>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>

<body>

	<div class="row">

<div class="col-9">
</div>

  <div class="col">
          <a href=" index.php"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg></a>  
        </div>
    </div>


<?php

$mysqli = mysqli_connect('localhost', 'u912555qno_xusan', 'dcamp1234', 'u912555qno_xusan');

$user_chaqirish = mysqli_query($mysqli, "SELECT * FROM user2");

$user_array = mysqli_fetch_all($user_chaqirish, MYSQLI_ASSOC);

//echo '<pre>'; print_r($user_array); echo '</pre>';



if(isset($_POST['edit_user'])){

$one_user = mysqli_query($mysqli, "UPDATE `user2` SET `NAME` = '$_POST[user_name]', `LOGIN` = '$_POST[user_login]', `PASSWORD` = '$_POST[user_password]' WHERE `user2`.`ID` = '$_SESSION[user_id]'");

header('Location: index.php');
}
?>
<br>
<h2>Edit user:</h2>
<br>

<table class="table table-bordered">
    <thead>
        <form method="POST">


    </thead>
    <tbody>

          <tr>
        <td>Name:</td>
        <td>
<label></label>
<input type="text" name="user_name"></td>
      </tr>

      <tr>
        <td>Login:</td>
        <td><label></label>
            <input type="text" name="user_login"></td>

      </tr>
      <tr>
        <td>Pasasword:</td>
        <td><label></label>
            <input type="text" name="user_password"></td>
     
      </tr>


      <tr>
        <td>Balance:</td>
       
        <td><label></label>
            <input type="text" name="user_balance"></td>
       
      </tr>
      <tr>
        <td></td>
        <td><div class="row">

<div class="col-6">
  <button class="btn btn-primary" type="submit" name="add_user">Edit user</button>
</div>

</div></td>
</tr>

</form>


    </tbody>
  </table>













</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>


</html>