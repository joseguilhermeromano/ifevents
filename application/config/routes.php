<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/* Rotas Login */
$route[ 'login/(:any)' ]              = 'LoginControl/$1';

/*Rotas Usuário*/
$route[ 'usuario/alterar/(:any)' ]    = 'UsuarioControl/alterar/$1';
$route[ 'usuario/ativar/(:num)' ]     = 'UsuarioControl/ativar/$1';
$route['usuario/notificar']			  = 'NotificacaoControl/notificaUsers';
$route[ 'usuario/desativar/(:num)' ]  = 'UsuarioControl/desativar/$1';
$route[ 'usuario/(:any)' ]            = 'UsuarioControl/$1';

/*Rotas Edição*/
$route[ 'edicao/(:any)' ]             = 'EdicaoControl/$1';
$route[ 'edicao/alterar/(:any)' ]     = 'EdicaoControl/alterar/$1';

/*Rotas Artigo*/
$route[ 'artigo/listar-atribuicoes' ]           = 'ArtigoControl/listarAtribuicoes';
$route[ 'artigo/eventos-recentes' ]             = 'ArtigoControl/submissaoEventosRecentes/$1';
$route[ 'artigo/detalhes-do-trabalho/(:any)' ]  = 'ArtigoControl/detalharTrabalho/$1';
$route[ 'artigo/download/(:any)/(:any)' ]  		= 'ArtigoControl/downloadArtigo/$1/$2';
$route[ 'artigo/cadastrar/(:any)' ]  			= 'ArtigoControl/cadastrar';
$route[ 'artigo/alterar/(:any)' ]  				= 'ArtigoControl/alterar/$1';
$route[ 'artigo/(:any)' ]             			= 'ArtigoControl/$1';

/*Rotas listagem revisores*/
$route[ 'revisor/consultar' ]             			= 'EdicaoControl/revisores';
$route[ 'revisor/convidar' ]             			= 'NotificacaoControl/convidarRevisor';
$route[ 'aceitar-convite/(:any)/(:any)' ]           = 'EdicaoControl/aceiteConviteRevisor/$1/$2';
$route[ 'recusar-convite/(:any)/(:any)' ]           = 'EdicaoControl/recusaConviteRevisor/$1/$2';
$route[ 'revisor/excluir-convite/(:any)/(:any)' ]   = 'EdicaoControl/excluirConvite/$1/$2';
$route[ 'revisor/(:any)' ]             				= 'EdicaoControl/$1';

/*Rotas da Modalidade*/
$route[ 'modalidade/(:any)' ]          = 'ModalidadeControl/$1';
$route[ 'modalidade/alterar/(:any)' ]  = 'ModalidadeControl/alterar/$1';
$route[ 'modalidade/excluir/(:any)' ]  = 'ModalidadeControl/excluir/$1';

/*Rotas dos Eixos Temáticas*/
$route[ 'eixo-tematico/(:any)' ]         = 'EixoTematicoControl/$1';
$route[ 'eixo-tematico/alterar/(:any)' ] = 'EixoTematicoControl/alterar/$1';
$route[ 'eixo-tematico/excluir/(:any)' ] = 'EixoTematicoControl/excluir/$1';

/*Rotas de Avaliações*/
$route[ 'revisao/consultar-atribuicoes' ] = 'AvaliacaoControl/consultarAtribuicoes';
$route[ 'revisao/(:any)' ]             = 'AvaliacaoControl/$1';

/*Rotas para Regras*/
$route[ 'regra-submissao/(:any)' ]        = 'RegraControl/$1';
$route[ 'regra-submissao/alterar(:any)' ] = 'RegraControl/alterar/$1';

/* Rota para selecionar evento area do organizador*/
$route[ 'edicao/selecionar-evento/(:any)' ] = 'EdicaoControl/selecionarEvento/$1';




$route[ 'instituicao/(:any)' ]        = 'InstituicaoControl/$1';
$route[ 'submissao/(:any)' ]          = 'SubmitControl/$1';
$route[ 'comite/(:any)' ]             = 'ComiteControl/$1';
$route[ 'contato/(:any)' ]            = 'ContatoControl/$1';
$route[	'(:any)' ]                    = 'InicioControl/$1';
$route[ 'conferencia/(:any)' ]        = 'ConferenciaControl/$1';
$route[ 'conferencia/alterar/(:any)'] = 'ConferenciaControl/alterar/$1';
$route[ 'conferencia/excluir/(:any)'] = 'ConferenciaControl/excluir/$1';
$route[	'default_controller' ]        = 'InicioControl';

$route[ 'translate_uri_dashes' ]      = FALSE;
