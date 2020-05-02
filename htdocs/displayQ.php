<html>

	<?php
	session_start();
	$dbh=pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=monstersinc");
	$username = $_SESSION['username'];
	if(!$dbh)
	{
		die("Error in connection: ".pg_last_error());
	}
	$sql = ("SELECT M.NAME, M.RELEASE_DATE, A.FIRST_NAME, A.LAST_NAME, R.NAME, D.FIRST_NAME, D.LAST_NAME, S.NAME
FROM MOVIE M, ACTOR A, ROLE R, ACTORPLAYS P, DIRECTOR D, DIRECTORDIRECTS I, STUDIO S, STUDIOSPONSORS O
WHERE M.MOVIEID=I.MOVIEID AND D.DIRECTORID=I.DIRECTORID AND M.MOVIEID=P.MOVIEID AND A.ACTORID=P.ACTORID AND R.ACTORID=A.ACTORID AND O.MOVIEID=M.MOVIEID AND S.STUDIOID=O.STUDIOID AND M.NAME='$moviename'");
	
	
	
	$result = pg_query($dbh, $sql);
	if(!$result)
	{
		die("Error in SQL query: " .pg_last_error());
	}
	
	
	?>
<?php $n = 0;?>
		<?php while($row=pg_fetch_array($result)) { ?>
		
				<a href="register_4_db.php"><?php echo $row[$n]; ?></a>
				<a href="register_4_db.php"><?php echo $row[1]; ?></a>
			
		<?php } ?>		
</html>
