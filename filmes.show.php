<?php
if($_SERVER['REQUEST_METHOD']=="GET"){

	if(!isset($GET['filme'])|| !is_numeric($GET['filme'])){
		echo '<script>alert("Erro ao abrir livro");</script>';
		echo 'Aguarde um momento.A reencaminhar página';
		header("refresh:5; url=index.php");
		exit();

		     }
		     $idfilme=$_GET['filme'];
		     $con=new mysqli("localhost","root","","filmes");

		     if($con->connect_errno!=0){
		     	echo 'Ocorreu um erro no acesso á base de dados.<br>'.$con->connect_error;
		     	exit;
		     }
	}
}