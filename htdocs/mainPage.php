<html>
	<head>
		<meta http-equiv= "Content Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style1.css"/>
				<link rel="stylesheet" type="text/css" href="css/style1.css"/>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<div class="wrapper">
	</head>

<style>
body{
  background:url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/dark_wall.png);
}

/*sass variables used*/
$full:100%;
$auto:0 auto;
$align:center;

@mixin disable{
  outline:none;
  border:none;
}
.center-screen
{
	text-align: center;
	height: 100%;
	width: 100%;
	padding: 50px 0;
	display: table;
}
@mixin easeme{
  -webkit-transition:1s ease;
  -moz-transition:1s ease;
  -o-transition:1s ease;
  -ms-transition:1s ease;
  transition:1s ease;
}

/*site container*/
.wrapper{
   width: 940px;
    margin-left: auto;
    margin-right: auto;
}

h1{
  padding:30px 0px 0px 0px;
  font:25px Oswald;
  color:#FFF;
  text-transform:uppercase;
  text-shadow:#000 0px 1px 5px;
  margin:0px;
}

p{
  font:13px Open Sans;
  color:#6E6E6E;
  text-shadow:#000 0px 1px 5px;
  margin-bottom:30px;
}

.form{
  width:$full;
}

input[type="text"],input[type="password"],select, table{
  width:98%;
  padding:15px 0px 15px 8px;
  border-radius:5px;
  box-shadow:inset 4px 6px 10px -4px rgba(0,0,0,0.3), 0 1px 1px -1px rgba(255,255,255,0.3);
	background:rgba(0,0,0,0.2);
  @include disable;
  border:1px solid rgba(0,0,0,1);
  margin-bottom:10px;
  color:#6E6E6E;
  text-shadow:#000 0px 1px 5px;
  .center-screen;
}

input[type="submit"]{
  width:20%;
  padding:15px;
  border-radius:5px;
  @include disable;
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#28D2DE), to(#1A878F));
  background-image: -webkit-linear-gradient(#28D2DE 0%, #1A878F 100%);
  background-image: -moz-linear-gradient(#28D2DE 0%, #1A878F 100%);
  background-image: -o-linear-gradient(#28D2DE 0%, #1A878F 100%);
  background-image: linear-gradient(#28D2DE 0%, #1A878F 100%);
  font:14px Oswald;
  color:#FFF;
  text-transform:uppercase;
  text-shadow:#000 0px 1px 5px;
  border:1px solid #000;
  opacity:0.7;
	-webkit-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
  -moz-box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
	box-shadow: 0 8px 6px -6px rgba(0,0,0,0.7);
  border-top:1px solid rgba(255,255,255,0.8)!important;
  -webkit-box-reflect: below 0px -webkit-gradient(linear, left top, left bottom, from(transparent), color-stop(50%, transparent), to(rgba(255,255,255,0.2)));
}

input:focus{
  box-shadow:inset 4px 6px 10px -4px rgba(0,0,0,0.7), 0 1px 1px -1px rgba(255,255,255,0.3);
  background:rgba(0,0,0,0.3);
  @include easeme;
}

input[type="submit"]:hover{
  opacity:1;
  cursor:pointer;
}
</style>
		<title>Movie Database</title>
		
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
	$dbh=pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=monstersinc");
	$username = $_SESSION['username'];
	if(!$dbh)
	{
		die("Error in connection: ".pg_last_error());
	}
	$sql = ("SELECT name,release_date FROM movie_recommender.movie");
	$search_sql = ("SELECT * FROM movie_recommender.movie WHERE name LIKE '%".(isset($_POST['search']) ? $_POST['search'] : null)."%'");
	
	
	$result2 = pg_query($dbh, $search_sql);
	if(pg_num_rows($result2)!=0){
		$search_rs= pg_fetch_assoc($result2);
	}
	
	$result = pg_query($dbh, $sql);
	if(!$result)
	{
		die("Error in SQL query: " .pg_last_error());
	}
	
	if(!$result2)
	{
		die("Error in SQL query: " .pg_last_error());
	}
	
	?>
	<h1><?php echo "WELCOME, $username";?></h1>
	
	<div style = "text-align:left; font:13px Open Sans;
  color:#6E6E6E;
  text-shadow:#000 0px 1px 5px;
  margin-bottom:30px;">
	Search:
	</div>
	<form name ="form1" method="post" >  
	<input name ="search" type = "text" size="40" maxlength="50" />
	<input type = "submit" name ="Submit" value="Search" />
	</form>
	
	<?php if(array_key_exists('Submit',$_POST)){ ?>
	<h1> Search results</h1>
	
	<table class ="gridtable">
		<tr>
			<th>Movie</Th>
		</tr>
	<?php if(pg_num_rows($result2)!= 0){
		do{?>
		<tr>
		<td><a href="register_4_db.php"><?php echo $search_rs['name']; ?></a></td>
		</tr>
	<?php	}while($search_rs = pg_fetch_assoc($result2));
		
	}
	else{
		echo"No results found";
	}
	pg_free_result($result2);
	}
	?>
	
<body>
	<h1>Movies available</h1>
	<table class ="gridtable">
		<tr>
			<th>Movie</Th>
			<th>Release Date</Th>
			
		</tr>
		
		<?php $n = 0;?>
		<?php while($row=pg_fetch_array($result)) { ?>
			<tr>
				<td><?php echo $row[$n]; ?></td>
				<td><?php echo $row[1]; ?></td>
			</tr>
		<?php } ?>		
	</table>
	<br/>
	<br/>
	<?php pg_free_result($result);
	pg_close($dbh);
	?>
	
	
</html>	