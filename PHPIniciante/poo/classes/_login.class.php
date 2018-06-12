<?php

	/**
	 * Classe de Teste para Login utilizando Traits
	 */
	class Login 
	{
		use Log;
		function logar($usuario){

			$this->log("O usuário ". $usuario . ", efetuou login");

		}
	}

?>