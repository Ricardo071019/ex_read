<?php
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
		<h1>Lista de Atores</h1>
		<?php
		$stm = $con->prepare('select * from atores');
		$stm->execute();
		$res=$stm->get_result();
		while($resultado = $res->fetch_assoc()){
			echo '<a href="atores_show.php?filme='.$resultado['id_ator'].'">';
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
		<body>
		<html>

		<?php
	}//end if - if($con->connect_errno!=0)
	?>
	
	</body>
	</html>
