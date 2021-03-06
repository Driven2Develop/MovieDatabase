<html>
	<head>
		<meta http-equiv = "Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/style1.css"/>
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<div class="wrapper">
<h1></h1>
		<title>Movie Recommendation Database</title>
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
			if(array_key_exists('Submit',$_POST)){
			$directorID = $_POST['idirectorID'];
			$conn_string="host=localhost port=5432 dbname=postgres user=postgres password=monstersinc";
			$dbconn=pg_connect($conn_string) or die('connection failed');
			
			$query="DELETE FROM movie_recommender.movietopics WHERE directorid = '$directorID'";
			
			$stmt=pg_query($dbconn,$query);
			$result = pg_execute($dbconn,"ps",array($username));
			
		
		if(!$result){
		die("error in SQL query:" .pg_last_error());
		}
		if(!$stmt){
		die("error in SQL query:" .pg_last_error());
		}
		
		?>
		<h1>The movie info has been deleted has been deleted </h1>
		<a href="search.php">Go back to administrator page</a>
<?php	}?>
<p> <label for="idirectorID" Movie ID:</label>
				<input name="idirectorID" type ="text" id="idirectorID"/>
			</p>
<input type = "submit" name ="Submit" value="Submit" />
</html>