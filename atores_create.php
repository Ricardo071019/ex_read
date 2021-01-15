<?php
session_start();
if(!isset($_SESSION['login'])){
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto" && isset($_SESSION['login'])){
	if($_SERVER['REQUEST_METHOD']=="POST"){
	$nome="";
	$nacionalidade="";
	$data_nascimento ="";
	$quantidade=0;

	if(isset($_POST['nome'])){
		$nome = $_POST['nome'];
	}
	else{
		echo '<scipt>alert("É obrigatorio o preenchimento do nome.");</script>';
	}
	if(isset($_POST['nacionalidade'])){
		$nacionalidade = $_POST['nacionalidade'];
	}
		if(isset($_POST['data_nascimento'])){
		$data_nascimento = $_POST['data_nascimento'];
	}
	$con = new mysqli("localhost","root","","filmes");
	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error;
		exit;
	}
	else {
		$sql = 'insert into atores(nome,nacionalidade,data_nascimento) values (?,?,?)';
		$stm = $con->prepare ( $sql);
		if($stm!=false){
			$stm->bind_param('sss',$nome,$nacionalidade,$data_nascimento);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Ator adicionado com sucesso");</script>';
			echo "Aguarde um momento.A reencaminhar página";
			header("refresh:5;url=index_atores.php");

		}
		else{
			echo ($con->error);
			echo  "Aguarde um momento.A reencaminhar página";
			header("refresh:5;url=index_atores.php");
		}

	}//end if -if($con->connect_errno!=0)

}//if($_SERVER['REQUEST_METHOD']=="POST")
else{//else if($SERVER['REQUEST_METHOD']=="POST")
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Adicionar Atores</title>
	</head>
	<body>
		<h1>Adicionar Atores</h1>
		<form action="atores_create.php" method="post">
			<label>Nome</label><input type="text" name="nome" required><br>
			<label>Nacionalidade</label><input type="text" name="nacionalidade"><br>
			<label>Data_Nascimento</label><input type="text" name="data_nascimento"><br>
			<input type="submit" name="enviar"><br>

		</form>
	
	</body>
	</html>
	<?php
}//end if -if($SERVER['REQUEST_METHOD']=="POST")
?>



<?php
}
else{
	echo 'Para entrar nesta pagina necessita de efetuar<a href="login.php">login</a>';
	header('refresh:2;url=login.php');
	
}
?>