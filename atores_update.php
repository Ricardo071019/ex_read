<?php
session_start();
if(!isset($_SESSION['login'])){
	$_SESSION['login']="incorreto";
}
if($_SESSION['login']=="correto" && isset($_SESSION['login'])){
	if($_SERVER['REQUEST_METHOD']='POST'){
$nome="";
$nacionalidade="";
$data_nascimento="";


if(isset($_POST['nome'])){
$nome=$_POST['nome'];
}
else{
echo '<script>alert("É obrigatorio o preenchimento do nome.");</script>';
}
if(isset($_POST['nacionalidade'])){
$nacionalidade = $_POST['nacionalidade'];
}
if (isset($_POST['data_nascimento'])) {
$data_nascimento=$_POST['data_nascimento'];
}
$con = new mysqli("localhost","root","","filmes");

if($con->connect_errno!=0){
echo "Ocorreu um erro no acesso à base de dados.<br>". $con->connect_error;
exit;
}
else{
$sql="insert into atores(nome, nacionalidade,data_nascimento)values(?,?,?);";
$stm = $con->prepare ($sql);

if($stm!=false){
$stm->bind_param("sss",$nome,$nacionalidade,$data_nascimento);
$stm->execute();
$stm->execute();
$stm->close();

echo '<script>alert("Ator alterado com sucesso!!");</script>';
echo "Aguarde um momento.A reencaminhar página";
header('refresh:5;url=index_atores.php');

}
else{
}
}
}
else{
echo "<h1>Houve um erro ao processar o seu pedido!<br>Irá ser reencaminhado!</h1>";
header ("refresh:5;url=index_atores.php");
}

}
else{
	echo 'Para entrar nesta pagina necessita de efetuar<a href="login.php">login</a>';
	header('refresh:2;url=login.php');
	
}


