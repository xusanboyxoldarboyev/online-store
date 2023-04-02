<!DOCTYPE html >
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=divice-width, initial-scale=1.0">
        <title>Document</title>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
    </head>

<body>

<?php
  

$user = db::array_single("SELECT * FROM user2 WHERE ID='$_SESSION[user_id]'");

if(isset($_GET['filter'])){

	if($_GET['type']=='prixod'){
		$type= "AND TYPE='prixod'";
	}
	if($_GET['type']=='rasxod'){
		$type= "AND TYPE='rasxod'";
	}
	if($_GET['date_to']!='' AND $_GET['date_from']!= ''){
		$date= "AND DATA BETWEEN '$_GET[date_from]' AND '$_GET[date_to]'";
	}
	if($_GET['date_to']!= '' AND $_GET['date_from']==''){
		$date= "AND DATA <= '$_GET[date_to]'";
	}
	if($_GET['date_to']== '' AND $_GET['date_from']!= ''){
		$date= "AND DATA >='$_GET[date_from]'";
	}
}
if (isset($_POST['edit_user'])) {

	$uptade = db::query("UPDATE `user2` SET `NAME` = '$_POST[user_name]', `LOGIN` = '$_POST[user_login]', `PASSWORD` = '$_POST[user_password]', `BALANCE` = '$_POST[user_balance]' WHERE `users`.`ID` = '$_SESSION[user_id]'");
	
	header('Location: index.php');
}
if (isset($_POST['add_transaction'])) {

    $add_transaction = db::query("INSERT INTO `transaction1` (`USER_ID`,`TYPE`, `SUMMA`, `DATA`, `COMMENT`) VALUES ('$_SESSION[user_id]', '$_POST[transaction_type]', '$_POST[transaction_sum]', '$_POST[transaction_date]', '$_POST[transaction_comment]')");

	if($_POST['transaction_type']=='rasxod') {
		$balance=$user['BALANCE'] - $_POST['transaction_sum'];
	}
	if($_POST['transaction_type']=='prixod') {
		$balance = $user['BALANCE'] + $_POST['transaction_sum'];
	}

    $uptade_balance = db::query("UPDATE `user2` SET `BALANCE` = '$balance' WHERE `user2`.`ID` = '$_SESSION[user_id]'");

	header('Location: index.php');
  
 /* if(isset($_GET['ID'])){                                                                                    
        $transaction_delete = mysqli_query($mysqli, "DELETE FROM transaction1 WHERE ID ='$_GET[ID]'");

        header("Location: index.php");
}
 */
}

?>
<div class="container">
    <div class="row">
		<div class="col-12 mt-3" style="text-align: right;">
		    <form method="POST">
                <button class="btn btn-danger" type="submit" name="chiqish">Chiqish</button>
			</form>
          <h1 style="text-align: center">MONEYMANAGER</h1>
		</div>
     
	</div>

	<div class="row">
		<div class="col-12 col-lg-6 col-md-3 mt-3">
			<form method="POST" class="form-control">
			    <label>Name:</label>
			    <input class="form-control" type="text" name="user_name" value="<?php echo $user['NAME'];?>">
                   
			    <label>Login:</label>
			    <input class="form-control" type="text" name="user_login" value="<?php echo $user['LOGIN'];?>">
                    
			    <label>Password:</label>
			    <input class="form-control" type="text" name="user_password" value="<?php echo $user['PASSWORD'];?>">
                    
			    <label>Balans:</label>
			    <input class="form-control" type="text" name="user_balance" value="<?php echo $user['BALANCE'];?>">
	               
			    <button class="btn btn-primary mt-2" type="submit" name="edit_user">Edit user</button>
			</form>
		</div>

		<div class="col-12 col-lg-6 col-md-3 mt-3">
			<form method="POST" class="form-control">
                <label>Type:</label>
			    <select class="form-control" name="transaction_type">
				    <option>prixod</option>
				    <option>rasxod</option>
			    </select>
	            
				<label>Data:</label>
			    <input class="form-control" type="date" name="transaction_date">
		  
				<label>Balans:</label>
			    <input class="form-control" type="text" name="transaction_sum">
		  
				<label>Comment:</label>
			    <input class="form-control" type="text" name="transaction_comment">
		   
			    <button class="btn btn-primary mt-2" type="submit" name="add_transaction">Add</button>
		    </form>
		</div>
    </div>
       
    <div class="row">
		<div class="col-12" style="text-align: center">
			<h2>PUL O'TKAZMALARI:</h2>
		</div>
		<div class="col-12 col-lg-6 col-md-3 mt-3 mb-3">
		  <form method="GET" class="form-control mb-3">
			
              
				<label>FILTER TYPE:</label>
					<select class="form-control mb-4" style="text-align: center" name="type">
                        <option <?php if ($_GET['type']=='all'){echo 'selected';}?>>all</option>
                        <option <?php if ($_GET['type']=='prixod'){echo 'selected';}?>>prixod</option>
                        <option <?php if ($_GET['type']=='rasxod'){echo 'selected';}?>>rasxod</option>
                    </select>
              
			

			
				<label>FROM:</label>
                <input class="form-control mb-4" style="text-align: center" type="date" name="date_from" value="<?php echo $_GET['date_from'];?>">
			

			
				<label>TO:</label>
                <input class="form-control mb-4" style="text-align: center" type="date" name="date_to" value="<?php echo $_GET['date_to'];?>">
			<div class="col-12" style="text-align: center">
                <button type="submit" style="text-align: center" class="btn btn-primary btn-lg btn-block mt-2 mb-2" name="filter">APPLY</button>
            </div>
	    </form> 
      </div>
	</div>     

	<div class="row">
        <div class="col-12">
            <table class="table table-dark table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="row" style="text-align: center;">ID</th>
                        <th scope="row" style="text-align: center;">TYPE</th>
                        <th scope="row" style="text-align: center;">SUMMA</th>
                        <th scope="row" style="text-align: center;">DATA</th>
                        <th scope="row" style="text-align: center;">COMMENT</th>  

                    </tr>
                </thead>
                <tbody>
                    <?php
                  
                     $tr = db::array_all("SELECT * FROM transaction1 WHERE USER_ID='$_SESSION[user_id]' $type $date");
                       foreach($tr as $rt):
                   //<td style="text-align: center"><a href="index.php?ID=<?php echo $key['ID'];>?"><button class="btn btn-outline-danger btn-sm" type="button">Delete</button></a></td>
                  	?>
                  <tr>
                    <td style="text-align: center"><?php echo $rt['ID'];?></td>
                    <td style="text-align: center"><?php echo $rt['TYPE'];?></td>
                    <td style="text-align: center"><?php echo $rt['SUMMA'];?></td>
                    <td style="text-align: center"><?php echo $rt['DATA'];?></td>
                    <td style="text-align: center"><?php echo $rt['COMMENT'];?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js">

</script>

</html>