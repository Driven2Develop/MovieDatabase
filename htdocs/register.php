<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style1.css"/>
		<title> Student Database</title>
	</head>
		<?php
		if(array_key_exists('save',$_POST))
		{
			$studentnum=$_POST['istudentnum'];
			$lastname=$_POST['ilastname'];
			$firstname=$_POST['ifirstname'];
			$password=$_POST['ipassword'];
			$street=$_POST['istreet'];
			$city=$_POST['icity'];
			$gender=$_POST['igender'];
			$email=$_POST['iemail'];
			$dbconn=pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=monstersinc") or die('Connection failed');
			$query = "INSERT INTO php_project.student(Student_num,last_name,First_name,Student_Pass,Street,City,Gender,Email) 
						Values('$studentnum','$lastname','$firstname','$password','$street','$city','$gender','$email')";
			$result=pg_query($dbconn,$query);
			if(!$result)
			{
				die("Error in SQL query:" .pg_last_error());
			}	
			echo "Data Successfully Entered ". "<a href='login.php'>login now</a>";

			pg_free_result($result);
			pg_close($dbconn);	
		}
	?>	
	<body>
	<div id ="header">USER REGISTRATION FORM</div>
		<form id="testform" name="testform" method="post" action="">
			<p> <label for="istudentnum">Student number:</label>
				<input name="istudentnum" type="text" id="repno"/>
			</p>
			<p> <label for="ilastname">Last name:</label>
				<input name="ilastname" type="text" id="ilastname"/>
			</p>
			<p> <label for="ifirstname">First name:</label>
				<input name="ifirstname" type="text" id="ifirstname"/>
			</p>
			<p> <label for="ipassword">Password:</label>
				<input name="ipassword" type="text" id="ipassword"/>
			</p>
			<p> <label for="iconfpassword">Confirm password:</label>
				<input name="iconfpassword" type="text" id="iconfpassword"/>
			</p>
			<p> <label for="istreet">Street:</label>
				<input name="istreet" type ="text" id="istreet"/>
			</p>
			<p> <label for="icity" id="formLabel">City:</label>
				<input name="icity" type="text" id="icity"/>
			</p>
			<p> <label for="igender">gender:</label>
				<select name ="igender">
					<option value="male">male</option>
					<option value="female">female</option>
				</select>				
			</p>
			<p> <label for="iemail">Email:</label>
				<input name="iemail" type="text" id="iemail"/>
			</p>
			<p> <input type="submit" name="save" value="Register"/>
			</p>
		</form>
	</body>
</html>	
			