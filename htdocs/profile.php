<html>
	<head>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<div class="wrapper">
  <h1>Make your profile</h1>
		<title> Movie Database</title>
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
		<?php
		if(array_key_exists('save',$_POST))
		{
			$userid = $_POST['userid'];
			$iage=$_POST['iage'];
			$year=$_POST['iyear'];
			$gender=$_POST['igender'];
			$occupation=$_POST['ioccupation'];
			$dbconn=pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=monstersinc") or die('Connection failed');
			$query = "INSERT INTO movie_recommender.profile(userid,age,year_born,gender,occupation) 
						Values($iage,$year,'$gender','$occupation', '$userid)";
			$result=pg_query($dbconn,$query);
			if(!$result)
			{
				die("Error in SQL query:" .pg_last_error());
			}	
			header('Location: http://localhost/success.php');
			pg_free_result($result);
			pg_close($dbconn);	
		}
	?>	
	<body>
		<form class="form" name="form" method="post" action="">
			<p> <label for="userid">Please input username again:</label>
				<input name="userid" type ="text" id="userid"/>
			</p>
			<p> <label for="iage">Age:</label>
				<input name="iage" type ="text" id="iage"/>
			</p>
			<p> <label for="iyear" id="formLabel">Year born:</label>
				<input name="iyear" type="text" id="iyear"/>
			</p>
<p> <label for="igender">Gender:</label>
				<select name ="igender">
					<option value="male">male</option>
					<option value="female">female</option>
				</select>	
				</p>
			<p> <label for="ioccupation">Occupation:</label>
				<input name="ioccupation" type="text" id="ioccupation"/>
			</p>
			<p> <input type="submit" name="save" value="Register"/>
			</p>
		</form>
	</body>
</html>	