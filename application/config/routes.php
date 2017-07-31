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
$route[ 'login/(:any)' ]              			    = 'LoginControl/$1';
/*Rotas Usuário*/
$route[ 'usuario/alterar/(:any)' ]    			    = 'UsuarioControl/alterar/$1';
$route[ 'usuario/ativar/(:num)' ]     			    = 'UsuarioControl/ativar/$1';
$route[ 'usuario/desativar/(:num)' ]  			    = 'UsuarioControl/desativar/$1';
$route[ 'usuario/(:any)' ]            			    = 'UsuarioControl/$1';
$route[ 'participante/(:any)']		  			      = 'ParticipanteControl/$1';
$route[ 'participante/alterar/(:any)']		  	  = 'ParticipanteControl/alterar/$1';
$route[ 'revisor/(:any)' ]		  	  			      = 'RevisorControl/$1';
$route[ 'revisor/alterar/(:any)' ]		  	      = 'RevisorControl/alterar/$1';
$route[ 'organizador/(:any)' ]		  	  		    = 'OrganizadorControl/$1';
$route[ 'organizador/alterar/(:any)' ]		  	  = 'OrganizadorControl/alterar/$1';
/*Rotas Edição*/
$route[ 'edicao/(:any)' ]                       = 'EdicaoControl/$1';
$route[ 'edicao/alterar/(:any)' ]               = 'EdicaoControl/alterar/$1';
$route[ 'edicao/consulta-anais-e-resultados/(:any)' ] = 'EdicaoControl/consultarAnaisResultados/$1';
$route[ 'edicao/file-delete-anais/(:any)' ] = 'EdicaoControl/deleteFileAnais/$1';
$route[ 'edicao/file-upload-anais/(:any)' ] = 'EdicaoControl/uploadFileAnais/$1';
$route[ 'edicao/file-delete-resultados/(:any)' ] = 'EdicaoControl/deleteFileResultados/$1';
$route[ 'edicao/file-upload-resultados/(:any)' ] = 'EdicaoControl/uploadFileResultados/$1';

//Rotas Atividade
$route[ 'atividade/(:any)' ]                    = 'AtividadeControl/$1';
$route[ 'atividade/consultarTudo/(:any)' ]      = 'AtividadeControl/consultarTudo/$1';
$route[ 'atividade/excluir/(:any)' ]            = 'AtividadeControl/excluir/$1';
$route[ 'atividade/alterar/(:any)' ]            = 'AtividadeControl/alterar/$1';
$route[ 'tipoatividade/(:any)' ]                = 'TipoAtividadeControl/$1';
$route[ 'tipoatividade/excluir/(:any)' ]        = 'TipoAtividadeControl/excluir/$1';
$route[ 'tipoatividade/alterar/(:any)' ]        = 'TipoAtividadeControl/alterar/$1';
/*Rotas Artigo*/
$route[ 'artigo/listar-atribuicoes' ]           = 'ArtigoControl/listarAtribuicoes';
$route[ 'artigo/eventos-recentes' ]             = 'ArtigoControl/submissaoEventosRecentes/$1';
$route[ 'artigo/detalhes-do-trabalho/(:any)' ]  = 'ArtigoControl/detalharTrabalho/$1';
$route[ 'artigo/download/(:any)/(:any)' ]       = 'ArtigoControl/downloadArtigo/$1/$2';
$route[ 'artigo/cadastrar/(:any)' ]             = 'ArtigoControl/cadastrar';
$route[ 'artigo/alterar/(:any)' ]               = 'ArtigoControl/alterar/$1';
$route[ 'artigo/(:any)' ]             			    = 'ArtigoControl/$1';
/*Rotas da Modalidade*/
$route[ 'modalidade/(:any)' ]                   = 'ModalidadeControl/$1';
$route[ 'modalidade/alterar/(:any)' ]           = 'ModalidadeControl/alterar/$1';
$route[ 'modalidade/excluir/(:any)' ]           = 'ModalidadeControl/excluir/$1';
/*Rotas dos Eixos Temáticas*/
$route[ 'eixo-tematico/(:any)' ]                = 'EixoTematicoControl/$1';
$route[ 'eixo-tematico/alterar/(:any)' ]        = 'EixoTematicoControl/alterar/$1';
$route[ 'eixo-tematico/excluir/(:any)' ]        = 'EixoTematicoControl/excluir/$1';
/*Rotas para Regras*/
$route[ 'regra-submissao/(:any)' ]              = 'RegraControl/$1';
$route[ 'regra-submissao/alterar(:any)' ]       = 'RegraControl/alterar/$1';
$route[ 'instituicao/(:any)' ]                  = 'InstituicaoControl/$1';
$route[ 'instituicao/alterar/(:any)' ]          = 'InstituicaoControl/alterar/$1';
$route[ 'instituicao/excluir/(:any)' ]          = 'InstituicaoControl/excluir/$1';
$route[ 'submissao/(:any)' ]                    = 'SubmitControl/$1';
$route[ 'comite/(:any)' ]                       = 'ComiteControl/$1';
//Rotas Contato
$route[ 'contato/(:any)' ]                      = 'ContatoControl/$1';
$route[ 'contato/consultar/(:any)' ]            = 'ContatoControl/consultar/$1';
$route[ 'contato/sendEmail/(:any)' ]            = 'ContatoControl/sendEmail/$1';
$route[ 'contato/responder/(:any)' ]            = 'ContatoControl/responder/$1';
$route[ 'contato/excluir/(:any)' ]              = 'ContatoControl/excluir/$1';
$route[	'(:any)' ]                              = 'InicioControl/$1';
//Rotas Inscricao
$route['inscricao/(:any)']                      = 'InscricaoControl/$1';
$route['inscricao/consultarTudo/(:any)']        = 'InscricaoControl/consultarTudo/$1';
$route['inscricao/inscricao/(:any)/(:num)']     = 'InscricaoControl/inscricao/&1/(:num)';
$route['inscricao/excluir/(:any)']              = 'InscricaoControl/excluir/$1';
/*Rotas listagem revisores*/
// $route[ 'revisor/consultar' ]             			= 'EdicaoControl/revisores';
// $route[ 'revisor/convidar' ]             			= 'NotificacaoControl/convidarRevisor';
// $route[ 'aceitar-convite/(:any)/(:any)' ]           = 'EdicaoControl/aceiteConviteRevisor/$1/$2';
// $route[ 'recusar-convite/(:any)/(:any)' ]           = 'EdicaoControl/recusaConviteRevisor/$1/$2';
// $route[ 'revisor/excluir-convite/(:any)/(:any)' ]   = 'EdicaoControl/excluirConvite/$1/$2';
// $route[ 'revisor/(:any)' ]             				= 'EdicaoControl/$1';
/*Rotas da Modalidade*/
$route[ 'modalidade/(:any)' ]          			= 'ModalidadeControl/$1';
$route[ 'modalidade/alterar/(:any)' ]  			= 'ModalidadeControl/alterar/$1';
$route[ 'modalidade/excluir/(:any)' ]  			= 'ModalidadeControl/excluir/$1';
/*Rotas dos Eixos Temáticas*/
$route[ 'eixo-tematico/(:any)' ]         		= 'EixoTematicoControl/$1';
$route[ 'eixo-tematico/alterar/(:any)' ] 		= 'EixoTematicoControl/alterar/$1';
$route[ 'eixo-tematico/excluir/(:any)' ] 		= 'EixoTematicoControl/excluir/$1';
/*Rotas de Avaliações*/
$route[ 'revisao/consultar-atribuicoes' ]   = 'AvaliacaoControl/consultarAtribuicoes';
$route[ 'revisao/atribuir-revisor' ]        = 'AvaliacaoControl/atribuirRevisor';
$route[ 'revisao/(:any)' ]                  = 'AvaliacaoControl/$1';
/* Rota para selecionar evento area do organizador*/
$route[ 'edicao/selecionar-evento/(:any)' ] = 'EdicaoControl/selecionarEvento/$1';
/*Rotas Conferência*/
$route[ 'conferencia/(:any)' ]              = 'ConferenciaControl/$1';
$route[ 'conferencia/alterar/(:any)']       = 'ConferenciaControl/alterar/$1';
$route[ 'conferencia/excluir/(:any)']       = 'ConferenciaControl/excluir/$1';
$route[	'default_controller' ]              = 'InicioControl';
$route[ 'translate_uri_dashes' ]            = FALSE;
