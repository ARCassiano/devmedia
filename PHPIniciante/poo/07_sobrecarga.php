<?php


/**
 * Exemplo de sobrecarga
 */
class Sobrecarga
{
	
	function __construct(argument)
	{
		# code...
	}

	//Responsável pela execução de uma operação matematica
	// 1 argumento  - Multipliação
	// 2 agrumentos - Soma
	// 3 agrumentos - Subtrair
	function operacao(){
		//func_num_args - Retorna a quantidade de parametros que a função recebeu
		switch (func_num_args()) {
			// Multiplicação
			case 1:
				//func_get_args - Retona o parametro de acordo com o indice
				$this->multiplica(func_get_args(0));
				break;
			
			//Soma
			case 2:
				$this->soma(func_get_args(0), func_get_args(1))
				break;
			
			//Subtrair
			case 3:
				$this->subtrai(func_get_args(0), func_get_args(1), func_get_args(2));
				break;
			
			default:
				echo "Nenhum parâmetro enviado!<br>";
				break;
		}
	}

	private function multiplica($var){
		echo "multiplicação:" . $var * $var . "<br>";
	}

	private function soma($var1, $var2){
		echo "soma: " . $var1 + $var2 . "<br>";
	}

	private function subtrai($var1, $var2, $var3){
		echo "subtração: " . $var1 - $var2 - $var3 . "<br>";
	}
}

$cl = new Sobrecarga();
$cl->operacao();
$cl->operacao(1);
$cl->operacao(1, 2);
$cl->operacao(1, 2, 3);
$cl->operacao(1, 2, 3, 4);
?>