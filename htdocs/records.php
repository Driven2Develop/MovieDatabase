<html>
	<head>
		<meta http-equiv= "Content Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style1.css"/>
		<title>Student Database</title>
		
		<style type ="text/css">
		
		table.gridtable{
			font-family: verdana,arial,sans-serif;
			font-size:11px;
			color:#3333333;
			border-width:1px;
			border-color:#666666;
			border-collapse:collapse;
		}
		
		table.gridtable th{
			border-width:1px;
			padding:8px;
			border-style:solid;
			border-color:#666666;
			background-color:#dedede;
		}
		
		table.gridtabletd{
			border-width:1px;
			padding:8px;
			border-style:solid;
			border-color:#666666
			background-colour:#ffffff;
		}
		</style>
	<?php
	session_start();
	
	if(!isset($_SESSION['studentnum']))
	{
		echo "Please"."<a href='login.html'>Login</a>";
		exit;
	}
	$dbh=pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=monstersinc");
	if(!$dbh)
	{
		die("Error in connection: ".pg_last_error());
	}
	$studentnum=$_SESSION['studentnum'];
	$sql = "SELECT c.COURSE, g.YEAR,g.SEC,g.GRADE 
			FROM php_project.Student s,php_project.Grades g,php_project.Courses c
			WHERE s.Student_Num=g.Student_Num AND g.Course_Num=c.Course_Num AND s.Student_Num=$1";
	$stmt = pg_prepare($dbh, "ps", $sql);
	$result=pg_execute($dbh,"ps",array($studentnum));
	if(!$result)
	{
		die("Error in SQL query: " .pg_last_error());
	}
	?>
<body>
	<div id="header">Student Record Details</div>
	<table class ="gridtable">
		<tr>
			<th>Course</Th>
			<th>Year</Th>
			<th>Session</Th>
			<th>Grade</Th>
		</tr>
		<tr>
			<td>suck my titties</td>
			<td>3</td>
			<td>Fall</td>
			<td>F</td>
		</tr>
		<?php while($row=pg_fetch_array($result)) { ?>
			<tr>
				<td><?php echo $row[0]; ?></td>
				<td><?php echo $row[1]; ?></td>
				<td><?php echo $row[2]; ?></td>
				<td><?php echo $row[3]; ?></td>
			</tr>
		<?php } ?>		
	</table>
	<br/>
	<br/><a href="update_profile.php?studentnum=<?php $studentnum; ?>">Update Profile</a>
	<?php pg_free_result($result);
	pg_close($dbh);
	?>
</html>	