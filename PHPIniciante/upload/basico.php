<!DOCTYPE html>
<html>
<head>
	<title>Ulpload de Arquivos</title>
</head>
<body>
	<form enctype="multipart/form-data" action="servico.php?p=uploadBasico" method="POST">
		<p>Selecione o arquivo</p>
		<input type="file" name="arquivo">
		<input type="submit" value="Enviar Arquivo">
		<input type="hidden" name="MAX_FILE_SIZE" value="30000">
	</form>
</body>
</html>