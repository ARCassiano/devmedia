<?php
/**
 *	Classe reponsável pela manutenção da aplicação
 */
class App
{
	/**
	 *	Dados de acesso ao banco de dados
	 */
	public $db_host	= "mysql.hostinger.com.br";
	public $db_user	= "u432556926_blog";
	public $db_pass	= "u432556926_";
	public $db_name	= "u432556926_blog";

	/**
	 *	Dados do site
	 */
	public $site_titulo	= "Curso de PHP";

	/**
	 *	Dados do sistema
	 */
	public $sistema_pasta_upload	= "upload";

	/**
	 *	Váriavel responsável pelo gerenciamento de conexões
	 */
	public $conexao;

	/**
	 *	Função construtor responsável pela instanciação da conexão com o banco de dados ($this->conexao)
	 */
	function __construct()
	{
		try {

			$param 	= array(
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
			);

			$this->conexao	= new PDO(
				"mysql:host=" . $this->db_host . ";port=3306;dbname=" . $this->db_name, 
				$this->db_user, 
				$this->db_pass, 
				$param
			);

		} catch (PDOException $e) {
			echo($e->getMessage());
			//echo("<br>" . "mysql:host=" . $this->db_host . ";port=3306;dbname=" . $this->db_name . "," . $this->db_user . "," . $this->db_pass);
		}
	}

	/**
	 *	Função responsável pelo carregamento de models da aplicação
	 */
	function loadModel($model){
		include("app/model/" . strtolower($model) . ".class.php");
		return new $model();
	}

	/**
	 *	Função responsável pelo carregamento de views da aplicação
	 */
	function loadView($view, $tpl){
		include("app/view/" . strtolower($view) . ".tpl.php");
	}

	function uploadImagem($arquivo){
		$img_tmp = $this->sistema_pasta_upload."tmp/".$arquivo['name'];
		
		$ext = strtolower(end(explode(".",$arquivo['name'])));
		
		if(array_search($ext,$this->ext_img) === 0) {
			if(move_uploaded_file($arquivo['tmp_name'], $img_tmp)){
				// criar um nome unico para o arquivo
				$foto = md5(uniqid(time())).".".$ext;
				
				include("libs/wideimage/WideImage.php");
				WideImage::load($img_tmp)->resize(614, 299)->saveToFile($this->sistema_pasta_upload.$foto);
				WideImage::load($img_tmp)->crop('center', 'center', 257, 247)->saveToFile($this->sistema_pasta_upload."thumb/".$foto);
			
				unlink($this->sistema_pasta_upload."tmp/".$arquivo['name']);
			
				return $foto;
			}
		} 
		
		return false;
	}
}






