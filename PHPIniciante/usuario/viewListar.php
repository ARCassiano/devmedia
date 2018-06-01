<!DOCTYPE html>
<html>
<head>
	<title><?= $titulo ?></title>
</head>
<body>
	<h1>Conteudo cadastrado no banco de dados</h1>

	<?php if(isset($retorno)){ ?>
		<h1><?= $retorno ?></h1>
	<?php } ?>

	<p><a href="index.php?r=usuario&p=cadastrar">Cadastrar</a></p>
	
	<table border="1">
		<tr>
			<td>id</td>
			<td>nome</td>
			<td>idade</td>
			<td></td>
			<td></td>
		</tr>
		<?php foreach ($dados as $linha) { ?>
				<tr>
					<td><?= $linha["id"] ?></td>
					<td><?= $linha["nome"] ?></td>
					<td><?= $linha["idade"] ?></td>
					<td>
						<a href="index.php?r=usuario&p=excluir&codigo=<?= $linha["id"] ?>" onclick="return confirm('Deseja realmente excluir o registro?');"> 
							Excluir
						</a>
					</td>
					<td>
						<a href="index.php?r=usuario&p=alterar&codigo=<?= $linha["id"] ?>"> 
							Editar
						</a>
					</td>
				</tr>
		<?php } ?>
	</table>
</body>
</html>

