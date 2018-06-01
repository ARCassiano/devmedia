<!DOCTYPE html>
<html>
<head>
	<title><?= $titulo ?></title>
</head>
<body>
	<h1>Formulario de Cadastro</h1>	
	<form action="index.php?r=usuario&p=<?= $acao ?>" method="POST">
		<p>
			Nome: 
			<input type="text" name="nome" maxlength="120" value="<?= $nome ?>">
		</p>
		<p>
			Idade: 
			<input type="number" name="idade" maxlength="3" value="<?= $idade ?>">
		</p>
		<p>
			<input type="submit" name="Cadastrar">
		</p>
		<input type="hidden" name="formUsuario" value="1">
		<input type="hidden" name="id" value="<?= $id ?>">
	</form>
</body>
</html>

