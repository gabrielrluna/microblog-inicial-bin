<?php 
use Microblog\Noticia;
use Microblog\Utilitarios;        
require_once "../inc/cabecalho-admin.php";

$noticia = new Noticia;

// Capturando o ID e o tipo do usuário logado e associando estes valores às propriedades do objeto "Usuário"
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION['tipo']);
$listaDeNoticias = $noticia->listar();
// Utilitarios::dump ($listaDeNoticias);
// die ();
?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Notícias <span class="badge bg-dark"><?= count($listaDeNoticias)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Título</th>
                        <th>Data</th>
						<?php if ($_SESSION['tipo'] === 'admin'){?><th>Autor</th>
                        <th>Destaque</th>
						<?php } ?>
						<th class="text-center">Operações</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach($listaDeNoticias as $noticias){ ?>
					<tr>
                        <td> <?= $noticias['titulo']?> </td>
                        <td> <?= Utilitarios::formataData($noticias['data'])?> </td>
						<?php if ($_SESSION ['tipo'] === 'admin'){?>
						<!-- ?? = Operador de Coalescência Nula
						Na prática, o valor à esquerda é exibido (caso exista).
						Caso contrário, o valor à direita é exibido-->
                        <td> <?= $noticias['autor'] ?? "<i>Equipe Microblog</i>" ?> </td>
                        <td> <?= $noticias['destaque']?> </td>
						<?php } ?>
						<td class="text-center">
							<a class="btn btn-warning" 
							href="noticia-atualiza.php?id=<?=$noticias['id']?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
					</tr>
				<?php } ?>
				</tbody>                
			</table>
	</div>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

