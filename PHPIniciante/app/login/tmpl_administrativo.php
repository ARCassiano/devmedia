<!DOCTYPE html>
<html>
<head>
	<title><?= $titulo ?></title>
</head>
<body>
	<h1>Seja bem-vindo <?= $_SESSION["usuario"] ?>, você esta logado!</h1>

	<a href="index.php?r=login&ac=logout">Logout</a>
</body>
</html>

