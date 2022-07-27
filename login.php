<?php 
use Microblog\Usuario;
require_once "inc/cabecalho.php";

// Mensagem de feedback relacionada ao acesso 
if(isset($_GET['acesso_proibido'])){
	$feedback = "Você deve logar primeiro!";
} elseif (isset($_GET['campos_obrigatorios'])) {
	$feedback = 'Você deve preencher os dois campos!';
} elseif (isset($_GET['nao_encontrado'])){
	$feedback = 'Usuário não encontrado';
}
?>


<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50">

                <?php if(isset($feedback)){?>
				<p class="my-2 alert alert-warning text-center">
				<?= $feedback?> <i class="bi bi-x-circle-fill"></i> </p>
                <?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

			</form>
    </div>
    
    
</div>        
        
<?php
// Verificação de campos do formulário
if (isset($_POST['entrar'])){
if(isset($_POST['email']) || empty($_POST['senha'])){
	header("location:login.php?campos_obrigatorios");
} else {
	// Capturamos o email informado
	$usuario = new Usuario;
	$usuario->setEmail($_POST['email']);

	// Buscando um usuario no banco a partir do email 
	$dados = $usuario->buscar();
// if($dados === false)
	if (!dados)	{
		// echo "nao tem ninguém nessa bagaça!";
		header ("location:login.php?nao_encontrado");
	} else {
		// Verificação de senha e login
		if(password_verify($_POST['senha'], $dados['senha'])){
			echo" o fulano pde entrar";
		} else {
			echo "cai fora";
		}
	}
}
}


?>
        
    



<?php 
require_once "inc/rodape.php";
?>

