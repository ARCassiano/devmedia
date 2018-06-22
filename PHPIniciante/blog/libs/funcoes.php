<?php
	/**
	 *	Arquivo de funções gerais
	 */

	/**
	 *	Função para a prevenção de SQL Injection e XSS
	 */	
	function tStr($str){
		return addslashes(
					htmlentities(
						utf8_decode(
							trim($str)
						)
					)
				);
	}
