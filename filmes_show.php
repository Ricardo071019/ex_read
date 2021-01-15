<?php
session_start();
if(!isset($_SESSION['login'])){
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto" && isset($_SESSION['login'])){
	if($_SERVER['REQUEST_METHOD']=="GET"){

	if(!isset($_GET['filme'])|| !is_numeric($_GET['filme'])){
		echo '<script>alert("Erro ao abrir livro");</script>';
		echo 'Aguarde um momento.A reencaminhar página';
		header("refresh:5; url=index.php");
		exit();

     }
		     $idFilme=$_GET['filme'];
		     $con= new mysqli("localhost","root","","filmes");

		     if($con->connect_errno!=0){
		     	echo 'Ocorreu um erro no acesso á base de dados.<br>'.$con->connect_error;
		     	exit;
		     }
		     else{
		     	$sql='select * from filmes where id_filme = ?';
		     	$stm = $con->prepare($sql);
		     	if($stm!=false){
		     		$stm->bind_param('i', $idFilme);
		     		$stm->execute();
		     		$res=$stm->get_result();
		     		$livro = $res->fetch_assoc();
		     		$stm->close();
		     	}
		     	else{
		     		echo '<br>';
		     		echo ($con -> error);
		     		echo '<br>';
		     		echo "Aguarde um momento.A reencaminhar página";
		     		echo '<br>';
		     		header("refresh:5; url=index.php");


		     	}


		     }//end if -if($con->connect_errno!=0)
	}//if($_SERVER['REQUEST_METHOD']=="GET")

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="ISO-8859-1">
	<title>Detalhes</title>
</head>
<body>
	<h1>Detalhes do filme</h1>
	<?php
		if(isset($livro)){
			echo '<br>';
			echo $livro['titulo'];
			echo '<br>';
			echo utf8_encode($livro['sinopse']) ;
			echo '<br>';
			echo $livro['idioma'];
			echo '<br>';
			echo $livro['data_lancamento'];
			echo '<br>';
			echo $livro['quantidade'];
			echo '<br>';
		}
		else{
			echo '<h2>Parece que o filme selecionado nao existe.<br>Confirme a sua seleçao.</h2>';
		}
		?>
		<a href="filmes_edit.php?filme=1">Editar</a><br>
		<br>
		<a href="filmes_delete.php?filme=1">Eliminar</a>
	</body>
	</html>
	<?php
}
else{
	echo 'Para entrar nesta pagina necessita de efetuar<a href="login.php">login</a>';
	header('refresh:2;url=login.php');
	
}
?>



