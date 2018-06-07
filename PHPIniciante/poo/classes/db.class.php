<?php

	/**
	 * Classe responsável pela conexão com o banco de dados
	 */
	class Database
	{

		/* ATRIBUTO RESPONSÁVEL PELA CONEXÃO COM O BANCO DE DADOS */
		public $connection;		

		/* ATRIBUTOS RESPONSÁVEIS PELA CONEXÃO COM O BANCO DE DADOS */
		protected $host;
		protected $name;
		protected $userName;
		protected $password;

		function __construct(argument)
		{
			$this->connection 	= null;
			$this->host 		= "mysql.hostinger.com.br";
			$this->name 		= "u432556926_exe01";
			$this->userName 	= "u432556926_exe01";
			$this->password 	= "u432556926";

			$this->connection	= mysqli_connect($this->host, $this->userName, $this->password, $this->name);

			if(mysqli_connect_errno($this->connection))
				$resultado	= "A conexão falhou, erro reportado: " . mysqli_connect_error();
		}

		function exec($sql){
			if($sql == "")
				return false;

			return mysqli_query($this->connection, $sql);
		}

		function __destruct(){
			mysqli_close($this->connection);
		}

?>