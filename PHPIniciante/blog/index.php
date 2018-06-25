<?php 
	/**
	 *	Arquivo principal da aplicação
	 */


	/**
	 *	Verirficar se o IP está em nossa blocklist
	 */
	$ipsbloqueados	= array();

	foreach ($ipsbloqueados as $ip) {
		if($ip == $_SERVER["REMOTE_ADDR"]){
			header("Location: ./negado.php");
			exit();
		}
	}

	/**
	 *	Arquivos essenciais
	 */
	require_once("libs/funcoes.php");
	require_once("application.php");

	/**
	 *	Previnir o cache nas páginas
	 */
	header("Expires: Mon, 21 Out 1999 00:00:00 GMT");
	header("Cache-control: no-cache");
	header("Pragma: no-cache");


	/**
	 *	Controle de acesso ao módulo ($modulo)
	 */
	$modulo = (isset($_GET["m"])) ? tStr($_GET["m"]) : "inicial";

	/**
	 *	Controle do Front-end
	 *		- Páginal Inicial
	 *		- Post
	 *		- Contato
	 */
	switch ($modulo) {
		case 'fale-conosco':
			# Controle do módulo Fale Conosco
			$app 		= new App();
			$site		= $app->loadModel("Site");			
			$mensagem	= "";
			$classe		= "";
			
			# Validar envio de e-mail
			if(isset($_GET["frm_enviar"])){

				# Recuperar dados da interface
				$nome	= tStr($_POST["nome"]);
				$email	= tStr($_POST["email"]);
				$msg	= tStr($_POST["mensagem"]);

				# Preparar Cabeçalho do e-mail
				$headers	 = "";
				$headers	.= "MIME-Version: 1.0 \r\n";
				$headers	.= "Content-type: text/html; charset=\"UTF-8\"  \r\n";
				$headers	.= "From:" . $nome . "<" . $email . ">";

				# Preparar mensagem do e-mail
				$mensagem	 = "Nome: " . $nome . " <br>";
				$mensagem	.= "Email: " . $email . "<br>";
				$mensagem	.= "Mensagem: " . $msg . " <br>";

				# Includes de configuração do SMTP
				include("libs/smtp/SMTPConfig.php");
				include("libs/smtp/SMTPClass.php");

				# Instanciando objeto SMTP
				$SMTPMail	= new SMTPClient(
												$SmtpServer,
												$SmtpPort,
												$SmtpUser,
												$SmtpPass,
												$SmtpUser,
												$SmtpUser,
												"E-mail enviado através do Site",
												$mensagem,
												$headers
											);

				# Tentavida de envio do e-mail, trantando mensagens de sucesso e falha
				if($SMTPMail->SendMail()){
					# Mensagem de sucesso
					$mensagem 	= "O E-mail foi enviado com sucesso!";
					$classe		= "alert-sucess";
				}else{
					# Mensagem de falha
					$mensagem 	= "O envio do E-mail falhou!";
					$classe		= "alert-danger";
				}
				# if($SMTPMail->SendMail())

			}
			# if(isset($_GET["frm_enviar"]))

			# Dados que devem ser carregados pela view
			$param	= array(
								"titulo"	=>	$app->site_titulo,
								"pagina"	=>	"contato",
								"contato"	=>	array(
													"mensagem"	=> $mensagem,
													"classe"	=> $classe
												)
							);

			# Chamada da view Site
			$app->loadView("Site", $param);
			
			break;
		case 'post':
			# Controle do módulo inicial (Posts) - Por URL amigável
			$app 	= new App();
			$site	= $app->loadModel("Site");
			
			# URL amigável do post
			$url	= isset($_GET["url"]) ? tStr($_GET["url"]) : "";

			# Buscar os dados do post, utilizando como parâmetro a URL amigável
			$post 	= $site->getPost($app->conexao, $codpost = null, $url);

			# Buscar as imagens do post
			$obj		= $site->listaImagensPost($app->conexao, $post->postid, "0");
			$imagens 	= $obj->fetchAll(PDO::FETCH_ASSOC);


			# Carregar array com as categorias do blog
			$obj			= $site->listaCategorias($app->conexao);
			$categorias 	= $obj->fetchAll(PDO::FETCH_ASSOC);


			# Renderizar o model
			renderizaVerPost($app, $categorias, $post, $imagens);
			break;
		case 'categoria':
			# Controle do módulo inicial (Posts) - Por categoria
			$app 	= new App();
			$site	= $app->loadModel("Site");
			
			# Carregar array com os posts do blog desbloquados e de uma determinda categoria
			$obj	= $site->listaPosts($app->conexao, 0, (int)$_GET["id"]);
			$posts 	= $obj->fetchAll(PDO::FETCH_ASSOC);

			# Carregar array com as categorias do blog
			$obj			= $site->listaCategorias($app->conexao);
			$categorias 	= $obj->fetchAll(PDO::FETCH_ASSOC);

			# Renderizar o model
			renderizaPaginaInicial($app, $categorias, $posts);
			break;
		
		default:
			# Controle do módulo inicial (Posts)
			$app 	= new App();
			$site	= $app->loadModel("Site");
			
			# Carregar array com os posts desbloquados do blog
			$obj	= $site->listaPosts($app->conexao, 0);
			$posts 	= $obj->fetchAll(PDO::FETCH_ASSOC);

			# Carregar array com as categorias do blog
			$obj			= $site->listaCategorias($app->conexao);
			$categorias 	= $obj->fetchAll(PDO::FETCH_ASSOC);

			# Renderizar o model
			renderizaPaginaInicial($app, $categorias, $posts);
			break;
	}



	/**
	 *	Função que irá recolher os dados e chamar a View do Site
	 */
	function renderizaPaginaInicial($app, $categorias, $posts){
		# Dados que devem ser carregados pela view
		$param	= array(
							"titulo"	=>	$app->site_titulo,
							"pagina"	=>	"inicial",
							"inicial"	=>	array(
												"posts"			=> $posts,
												"categorias"	=> $categorias
											)
						);

		# Chamada da view Site
		$app->loadView("Site", $param);
	}

	/**
	 *	Função que irá recolher os dados e chamar a View do Site, exibindo apenas um post
	 */
	function renderizaVerPost($app, $categorias, $post, $imagens){
		# Dados que devem ser carregados pela view
		$param	= array(
							"titulo"	=>	$app->site_titulo,
							"pagina"	=>	"verpost",
							"verpost"	=>	array(
												"post"			=> $post,
												"categorias"	=> $categorias,
												"imagens"		=> $imagens
											)
						);

		# Chamada da view Site
		$app->loadView("Site", $param);
	}