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

/* Rotas Corretas */

// $route[ 'organizador' ]         = 'OrganizadorControl/index';
// $route[ 'organizador/(:any)' ]  = 'OrganizadorControl/$1';
// $route[ 'participante' ]        = 'ParticipanteControl/index';
// $route[ 'participante/(:any)' ] = 'ParticipanteControl/chamaView/$1';
// $route[ 'avaliador' ]           = 'AvaliadorControl/index';
// $route[ 'avaliador/(:any)' ]    = 'AvaliadorControl/$1';
$route[ 'login/(:any)' ]        = 'LoginControl/$1';
/*Rotas Usuário*/
$route[ 'usuario/alterar/(:any)' ]        = 'UsuarioControl/alterar/$1';
$route[ 'usuario/ativar/(:num)' ]        = 'UsuarioControl/ativar/$1';
$route[ 'usuario/desativar/(:num)' ]        = 'UsuarioControl/desativar/$1';
$route[ 'usuario/(:any)' ]        = 'UsuarioControl/$1';
/*Rotas Edição*/
$route[ 'edicao/(:any)' ]        = 'EdicaoControl/$1';
$route[ 'artigo/(:any)' ]        = 'ArtigoControl/$1';
$route[ 'instituicao/(:any)' ]        = 'InstituicaoControl/$1';
$route[ 'submissao/(:any)' ]        = 'SubmitControl/$1';
$route[ 'comite/(:any)' ]        = 'ComiteControl/$1';
$route[ 'contato/(:any)' ]        = 'ContatoControl/$1';
$route[	'(:any)' ]              = 'InicioControl/$1';
$route[	'default_controller' ]  = 'InicioControl';



//$route[	'administracao' ]          = 'administracao/Home';
//$route[	'submissao' ]			   = 'InicioControl/submissao';
//$route[	'cadastro' ]               = 'InicioControl/cadastro';

//$route['login']					   = 'InicioControl/login';
//$route[ 'VerificaArtigo' ]         = 'DataControl/VerificaArtigo';
//$route[ 'Download/(:any)/(:any)' ] = 'DataControl/Download/$1/$2';
//$route[ 'avaliador' ]              = 'AreaRestritaControl/avaliador';
//$route[ 'avaliador/(:any)' ]       = 'AreaRestritaControl/avaliador/$1';
//
//$route[ 'participante' ]           = 'AreaRestritaControl/participante';
//$route[ 'participante/(:any)' ]    = 'AreaRestritaControl/participante/$1';
//$route[ 'novoartigo' ]             = 'ParticipanteControl/novoartigo';
//$route[ '404_override' ]           = 'InicioControl/error_404';
$route[ 'translate_uri_dashes' ]   = FALSE;
