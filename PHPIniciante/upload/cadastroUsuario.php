<html>
	<head>
		<title>Cadastro de usuario</title>
	</head>
	<body>
		<form enctype="multipart/form-data" action="servico.php?p=cadUsuario" method="POST">
			<p>Nome do Usuário:</p>
			<p><input type="text" maxlength="120" name="txtNomeUsuario" /></p>
			
			<p>Idade:</p>
			<p><input type="text" maxlength="3" name="txtIdadeUsuario" /></p>
			
			Selecione a foto:
			<input type="file" name="arquivo"/>
			<br/>
			<input type="submit" value="Enviar arquivo"/>
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
		</form>		
	</body>
</html>