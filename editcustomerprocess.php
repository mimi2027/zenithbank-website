<?php
include('connect.php');

	$fname=$_POST['name'];
    $age=$_POST['age'];
    $address=$_POST['address'];
	$balance=$_POST['balance'];
   
    




if (isset($_POST["edit"])) {
    $name = mysqli_real_escape_string($db_con, $_POST["name"]);
    $age = mysqli_real_escape_string($db_con, $_POST["age"]);
    $address = mysqli_real_escape_string($db_con, $_POST["address"]);
    $balance = mysqli_real_escape_string($db_con, $_POST["balance"]);
    $id = mysqli_real_escape_string($db_con, $_POST["id"]);
    $sqlUpdate = "UPDATE customer SET name = '$name', age = '$age', address = '$address', balance = '$balance' WHERE id='$id'";
    if(mysqli_query($db_con,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "customer Record Updated Successfully!";
        header("Location: viewcustomer.php");
    }else{
        die("Something went wrong");
    }
	}

	

?>