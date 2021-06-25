<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login Form</title>
</head>
<body>
	<h1>Login Form</h1>
	<?php
	define("filepath", "data.txt");
	$username=$password = "";
	$usernameErr = $passwordErr = "";
	$successfulMessage = $errorMessage= "";
	$flag = false;

	if($_SERVER['REQUEST_METHOD']==="POST"){
	    $username = $_POST['username'];
		$password = $_POST['password'];

		if(empty($username)){
			$usernameErr = "Username cannot be empty!";
			$flag =true;
		}
	    if(empty($password)){
			$passwordErr = "Password cannot be empty!";
			$flag =true;
		}
		if(!$flag){
			$username = test_input($username);
			$password = test_input($password);
			$data[] = array("username" =>$username, "password" =>$password);
            $data_encode = json_encode($data);
            $result1 = write($data_encode);
			
			if($result1){
			$successfulMessage = "Successfully saved";

			
		}
		else{
			$errorMessage = "Error while saving.";

		}
	}
}
	function write($content){
		$resource = fopen(filepath,"a");
		$fw = fwrite($resource, $content . "\n");
		fclose($resource);
		return $fw;


	}
	function test_input($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	?>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);
	?>" method="POST">
 	<label for="username">Username<span style="color: red;">*</span>:</label>
    <input type="text" name="username" id="username" placeholder="Enter your username">
    <span style="color: red;"><?php echo $usernameErr; ?></span>   
    <br><br>

    <label for="password">Password<span style ="color: red;">*</span>:
    </label>
 	 <input type="password" name="password" id="password" placeholder="Enter your password">
 	 <span style="color: red;"><?php echo $passwordErr; ?></span> 
 	 <br><br>
 	 <input type ="submit" name="submit" value="Login">
 	 </form>
    <br>
    <span style="color: green;"><?php echo $successfulMessage; ?></span> 
    <span style="color: red;"><?php echo $errorMessage; ?></span> 
   
 	 </body>
 	 </html> 