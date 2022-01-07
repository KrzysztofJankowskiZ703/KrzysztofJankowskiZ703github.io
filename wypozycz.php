<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>YachtLand.pl</title>
	
	<meta name="description" content="Wizytowka strony YachtLand.pl" />
	<meta name="keywords" content="Łodzie" />

  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="style1.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div class="jumbotron text-center">
  <h1>YachtLand.pl</h1>
</div>
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">YachtLand.pl</a>
    </div>
    <ul class="nav navbar-nav">
	  <li><a href="index.html">O nas</a></li>
      <li><a href="lodzie.html">Łodzie</a></li>
      <li><a href="#">Wypożycz</a></li>
    </ul>
  </div>
</nav>
<div class="container">

<h2>Wypożyczalnia</h2>
<form method="POST" action="wypozycz.php">
<table padding="5px">
<div class="form-group">
<div class="form-group">

<tr><td><label for="usr">Łódź: </label></td><td>
<select class='form-control' id='sel1' name='nazwa'>
<?php
$srv='localhost';
$usr='root';
$passwd='';
$db='lodzie';
$connect=mysqli_connect($srv,$usr,$passwd,$db);
$kwerenda='';

	$kw1=mysqli_query($connect,"select * from lodzie");
	$liczba=mysqli_num_rows($kw1);
	
	$x=0;
	$kw1=mysqli_query($connect,"select * from lodzie");
	while($x<$liczba){
		$rekord=mysqli_fetch_array($kw1,MYSQLI_NUM);
		printf('<option>'.$rekord[1].'</option>');
		$x++;
	}
	
?>
  </select>
</div></tr>
<div class="form-group">
<tr><td><label for="usr">Imie: </label></td><td><input type="text" class="form-control" name="imie"></tr>
<tr><td><label for="usr">Nr. tel.: </label></td><td><input type="text" class="form-control" name="nr_tel"></tr>
<tr><td><label for="usr">Od: </label></td><td><input type="date" class="form-control" value="<?php echo date("Y-m-d");?>" name="od"></tr><td><label for="usr">Do: </label></td><td><input type="date" value="Do:" class="form-control" name="do"></tr>
<tr><td></td><td><button type="submit" class="btn btn-primary">Wypożycz</button><td></tr>
</div>
</form>

<?php


error_reporting(0);

$srv='localhost';
$usr='root';
$passwd='';
$db='lodzie';
$connect=mysqli_connect($srv,$usr,$passwd,$db);
$nazwa=@$_POST['nazwa'];
$do=@$_POST['do'];
$imie=@$_POST['imie'];
$od=@$_POST['od'];
$nr_tel=@$_POST['nr_tel'];
$kwerenda='';
$kwerenda2='';
$date=date("Y-m-d");
$mozna=false;

if(empty($nazwa) or empty($imie) or empty($nr_tel) or empty($od) or empty($do)){

	echo "xD";
	}else{
		$kwerenda2=mysqli_query($connect,"select nazwa,do from wypozyczenia ORDER BY do DESC");
		$x=0;
		$mozna=false;
		$liczba=mysqli_num_rows($kwerenda2);
		while($x<=$liczba){
			$rekord=mysqli_fetch_array($kwerenda2,MYSQLI_NUM);
				if($nazwa==$rekord[0]){
				
					if($od<$rekord[1]){
						echo "Ta łódź nie jest dostepna w tym terminie, koniec wypożyczenia to ".$rekord[1];
						return $x;
					}else{

					}
					}else{
							$mozna=true;
		
			}
			$x++;
	}
	
	
	if(($mozna)){
							$kwerenda=mysqli_query($connect,"insert into wypozyczenia VALUES ('','$nazwa','$imie','$nr_tel','$od','$do')");
							echo '<p>Gratulacje wypożyczyłeś łódź</p>';
		}
	$mozna=false;
	
		}
		
#	
##		if($nazwa==$rekord[0] and $od<$rekord[1]){
#			echo "Ta łódź nie jest dostepna w tym terminie, koniec wypożyczenia to ".rekord[1];
#		}else{
#		echo $rekord[0];
#		
#		$kwerenda=mysqli_query($connect,"insert into wypozyczenia VALUES ('','$nazwa','$imie','$nr_tel','$od','$do')");
#		echo '';
	
	
	


	echo "</table>";
	
?>
</div>
</div>
<div class="footer">YachtLand.pl &copy; Wszelkie prawa zastrzeżone</div>
</body>
</html>