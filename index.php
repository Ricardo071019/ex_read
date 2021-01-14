<?php
session_start();
if(!isset($_SESSION['login'])){
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto" && isset($_SESSION['login'])) {
	$con= new mysqli("localhost","root","","filmes");
if($con->connect_errno!=0){
	echo "Ocorreu um erro no acesso á base de dados".$con->connect_error;
	exit;
}
else{
	?>

	<!DOCTYPE html>
	<html>
	<head>
	<meta charset="ISO-8859-1">
		<title>filmes</title>
	</head>
	<body style="background-color:#f0f0ff ">
		<h1>Lista de filmes</h1>
		<?php
		$stm = $con->prepare('select * from filmes');
		$stm->execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()){
			echo '<a href="filmes_show.php?filme='.$resultado['id_filme'].'">';
			echo $resultado['titulo'];
			echo '</a>';
			echo '<br>';
		}
		$stm->close();
		?>
		<br>
		<br>
		<a href="filmes_create.php"><button type="button" class="btn btn-success">Faz um novo registo</button></a>
		<br>
		<a href="processa_logout.php">Sair</a>
		

		<?php
	}//end if - if($con->connect_errno!=0)
	?>
	
	</body>
	</html>
<?php
}
else{
	echo 'Para entrar nesta pagina necessita de efetuar<a href="login.php">login</a>';
	header('refresh:2;url=login.php');
	
}
?>
