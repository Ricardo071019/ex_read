<?php

if($_SERVER['REQUEST_METHOD']='POST'){
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
	$con = new mysqli("localhost","root","","atores");
	if($con->connect_errno!=0){
		echo "Ocorreu um erro no acesso á base de dados.<br>".$con->connect_error;
		exit;
	}
else {
		$sql = 'insert into atores(nome,nacionalidade,data_nascimento) values (?,?,?,?,?)';
		$stm = $con->prepare ( $sql);
		if($stm!=false){
			$stm->bind_param('sssis',$nome,$nacionalidade,$data_nascimento);
			$stm->execute();
			$stm->close();

			echo '<script>alert("Atore aduicionado com sucesso");</script>';
			echo "Aguarde um momento.A reencaminhar página";
			header("refresh:5;url=index.php");

		}
		else{
			echo ($con->error);
			echo  "Aguarde um momento.A reencaminhar página";
			header("refresh:5;url=index.php");
		}

else{
}
}
}
else{
echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
header ("refresh:5;url=index.php");
}
