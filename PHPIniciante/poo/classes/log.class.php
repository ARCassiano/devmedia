<?php 
	/*
	*	Trait responsável pelo gerenciamento de logs
	*/
	trait Log{
		
		function log($mensagem){
			echo $mensagem . " - " . date("d/m/Y H:i:s") . "<br>";
		}
	}

?>