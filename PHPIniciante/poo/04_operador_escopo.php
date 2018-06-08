<?php
	
	define("IDIOMA", "pt-br");

	require("language/". IDIOMA .".lang.php");
	
	echo Lang::MENSAGEM_DE_BOAS_VINDAS . "<br>" . Lang::MENSAGEM_DE_SAIDA_DO_SISTEMA;
?>