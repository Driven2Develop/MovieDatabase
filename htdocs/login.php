<html>
	<head>
		<meta http-equiv = "Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style1.css"/>
		<title>Movie Recommendation Database</title>
	</head>
	<?php
		session_start();
		if(array_key_exists('login',$_POST))
		{
			$studentnum=$_POST['studentnum'];
			$password=$_POST['studentpass'];
			
			$conn_string="host=localhost port=5432 dbname=postgres user=postgres password=monstersinc";
			
			$dbconn=pg_connect($conn_string) or die('connection failed');
			
			$query="SELECT * FROM php_project.Student WHERE Student_NUM=$1 AND STUDENT_PASS=$2";
			
			$stmt=pg_prepare($dbconn,"ps", $query);
			$result = pg_execute($dbconn,"ps",array($studentnum,$password));
		
		if(!$result){
		die("error in SQL query:" .pg_last_error());
		}
		$row_count= pg_num_rows($result);
		if($row_count>0){
		$_SESSION['studentnum']=$studentnum;
		header("location: http://localhost/search.php");
		exit;
		}
		echo " ". "<a href='login.php'>login now</a>";
		
		pg_free_result($result);
		pg_close($dbconn);
		}
	?>	
	
		
	<body>
	
	<div id="header">USER LOGIN FORM</div>
		<form method ="POST" action="">
			<p> Student number: <input type="text" name="studentnum" id="studentnum"/> </p>
			<p> Password: <input type= "password" name="studentpass" id = "studentpass"/> </p>
			<p><input type="submit" value="Login" name= "login" id="login" /> </p>
			
		</form>
		<a href="register.php">Register</a>
	</body>
</html>	
		