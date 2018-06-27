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
		case 'admin':
			# Controle do módulo Fale Conosco
			$app 	= new App();

			# Indicando o inicio de session, será utilizado para validar se o usuário está logado
			session_start();

			# Verirfica se o usuário esta logado
			if (isset($_SESSION["usuario"])) {
				# Usuário logado

				$comp	= (isset($_GET["c"])) ? tStr($_GET["c"]) : null ;
				$action	= (isset($_GET["a"])) ? tStr($_GET["a"]) : null ;

				switch ($comp) {
					case 'categorias':
						# Componente de gerenciamento de categorias
						include("app/controller/categoria.class.php");

						$categoria 	= new Categoria();

						if($action != null){
							# Executar ação requisitada. 
							/**
							 *	Ao utilizar a váriavel $action ao invés de chamar o método é uma forma de chamar o método de forma dinamica
							 *	Desta forma a váriavel recebe o nome do método 
							 *	A classe identifica que está sendo chamado o método com o mesmo nome que o valor da váriavel
							 *	$categoria->$action, a váriavel $action atua como a chamda de método de forma dinâmica
							 */
							$categoria->$action($app);
						}else{
							# Listagem de categorias
							$categoria->listarCategorias($app);
						}

						break;
					case 'usuarios':
						# Componente de gerenciamento de usuários
						include("app/controller/usuario.class.php");

						$usuario 	= new Usuario();

						if($action != null){
							# Executar ação requisitada. 
							/**
							 *	Ao utilizar a váriavel $action ao invés de chamar o método é uma forma de chamar o método de forma dinamica
							 *	Desta forma a váriavel recebe o nome do método 
							 *	A classe identifica que está sendo chamado o método com o mesmo nome que o valor da váriavel
							 *	$usuario->$action, a váriavel $action atua como a chamda de método de forma dinâmica
							 */
							$usuario->$action($app);
						}else{
							# Listagem de usuários
							$usuario->listarUsuarios($app);
						}

						break;
					default:
						# Renderizar a pagina inicial do sistema administrativo
						renderizaAdminInicial($app);
						break;
				}
			}else{
				# Usuário não logado
				renderizaLogin($app);
			}

			break;
		case 'doLogin':
			# Controle do módulo Fale Conosco
			$app 	= new App();
			
			$admin 		= $app->loadModel("Admin");
			$usuario	= tStr($_POST["usuario"]);
			$senha		= md5(tStr($_POST["senha"]));

			# Tentativa de Login
			$obj = $admin->getUsuarioLoginSenha($app->conexao, $usuario, $senha);

			if($obj){
				# Indicando o inicio de session, será utilizado para validar se o usuário está logado
				session_start();
				$_SESSION["usuarioid"]		= $obj->usuarioid;
				$_SESSION["usuario"]		= $usuario;
				$_SESSION["usuarionome"]	= $obj->usuarionome;

				renderizaAdminInicial($app);
			}else{
				# Usuário não logado - Login Falhou
				echo("<script>alert('Login ou senha incorreto(s)');</script>");
				renderizaLogin($app);
			}

			break;
		case 'logout':
			echo("<script>alert('Usuário desconectado com sucesso!');</script>");
			$app 	= new App();

			# Encerra todas as sessões, assim desconectando o usuário
			session_start();
			session_destroy();

			renderizaLogin($app);
			break;
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
				$msg	= ($_POST["mensagem"]);

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
			$obj	= $site->listaPosts($app->conexao, "0", (int)$_GET["id"]);
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

	function renderizaAdminInicial($app){
		# Setar o model Site para pegar as funções com o banco de dados
		$site 	= $app->loadModel("Site");

		# Carregar posts
		$obj 	= $site->listaPosts($app->conexao);
		$posts 	= $obj->fetchAll(PDO::FETCH_ASSOC);

		# Dados que devem ser carregados pela view
		$param	= array(
							"titulo"	=>	$app->site_titulo,
							"pagina"	=>	"inicialadmin",
							"dados"	=>	array(
												"posts"	=> $posts
											)
						);

		# Chamada da view Site
		$app->loadView("Admin", $param);
	}

	/**
	 *	Função que irá mostrar a view responsável pelo login
	 */
	function renderizaLogin($app){
		$param	= array("titulo"	=>	$app->site_titulo);

		# Chamada da view Login
		$app->loadView("Login", $param);
	}