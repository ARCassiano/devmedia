<!DOCTYPE html>
<html>
<head>
	<title><?= $titulo ?></title>
</head>
<body>
	<h1>Conteudo cadastrado no banco de dados</h1>
	<table border="1">
		<tr>
			<td>id</td>
			<td>nome</td>
			<td>idade</td>
		</tr>
		<?php foreach ($dados as $linha) { ?>
				<tr>
					<td><?= $linha["id"] ?></td>
					<td><?= $linha["nome"] ?></td>
					<td><?= $linha["idade"] ?></td>
				</tr>
		<?php } ?>
	</table>
</body>
</html>

