<?php

/**
 * Exemplo de polimorfismo
 */
class PrimeiraClasse
{
	
	function conectar(){
		echo "Chamou o metodo conectar da PrimeiraClasse<br>";
	}
}

class SegundaClasse extends PrimeiraClasse
{
	
	function conectar(){
		echo "Chamou o metodo conectar da SegundaClasse<br>";
	}
}

class TerceiraClasse extends SegundaClasse
{
	
	function conectar(){
		echo "Chamou o metodo conectar da TerceiraClasse<br>";
	}
}

$var1 = new PrimeiraClasse();
$var2 = new SegundaClasse();
$var3 = new TerceiraClasse();


$var1->conectar();
$var2->conectar();
$var3->conectar();
?>