<!DOCTYPE html>
<html>
<head>
	<title><?= $titulo ?></title>
</head>
<body>
	<p>Efetue o login para ter acesso ao sistema</p>
	<form action="" method="post">
		<p>Usuário: </p>
		<input type="text" name="usuario">

		<p>Senha: </p>
		<input type="password" name="senha">

		<p><input type="checkbox" name="lembrar" value="1"> Manter logado</p>
		<input type="submit" name="ok">
	</form>
</body>
</html>

