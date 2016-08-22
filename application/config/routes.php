<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "login_control";
$route['404_override'] = '';

$route['empresa'] = "empresa_control";
$route['empresa/p'] = "empresa_control";
$route['empresa/p/(:num)'] = "empresa_control";

$route['empresa/salvar'] = "empresa_control/salvar";
$route['empresa/editar'] = "empresa_control/editar";


$route['usuario'] = "usuario_control";
$route['usuario/p'] = "usuario_control";
$route['usuario/p/(:num)'] = "usuario_control";
$route['usuario/b'] = "usuario_control/filtarRegistros";
$route['usuario/b/(:num)'] = "usuario_control/filtarRegistros";

$route['usuario/salvar'] = "usuario_control/salvar";
$route['usuario/editar'] = "usuario_control/editar";
$route['usuario/ativar'] = "usuario_control/ativar";
$route['usuario/verificarlogin'] = "usuario_control/verificaLoginExistente";
$route['usuario/filtarRegistros'] = "usuario_control/filtarRegistros";

$route['login'] = "login_control";
$route['login/buscarempresa'] = "login_control/buscarEmpresa";
$route['login/entrar'] = "login_control/entrar";
$route['login/sair'] = "login_control/sair";

$route['seguradora'] = "seguradora_control";
$route['seguradora/salvar'] = "seguradora_control/salvar";
$route['seguradora/editar'] = "seguradora_control/editar";
$route['seguradora/ativar'] = "seguradora_control/ativar";
$route['seguradora/filtarRegistros'] = "seguradora_control/filtarRegistros";
$route['seguradora/p'] = "seguradora_control";
$route['seguradora/p/(:num)'] = "seguradora_control";
$route['seguradora/b'] = "seguradora_control/filtarRegistros";
$route['seguradora/b/(:num)'] = "seguradora_control/filtarRegistros";


$route['produto'] = "produto_control";
$route['produto/salvar'] = "produto_control/salvar";
$route['produto/editar'] = "produto_control/editar";
$route['produto/ativar'] = "produto_control/ativar";
$route['produto/filtarRegistros'] = "produto_control/filtarRegistros";
$route['produto/p'] = "produto_control";
$route['produto/p/(:num)'] = "produto_control";
$route['produto/b'] = "produto_control/filtarRegistros";
$route['produto/b/(:num)'] = "produto_control/filtarRegistros";


$route['condicao_comissionamento'] = "condicao_comissionamento_control";
$route['condicao_comissionamento/salvar'] = "condicao_comissionamento_control/salvar";
$route['condicao_comissionamento/editar'] = "condicao_comissionamento_control/editar";
$route['condicao_comissionamento/ativar'] = "condicao_comissionamento_control/ativar";
$route['condicao_comissionamento/filtarRegistros'] = "condicao_comissionamento_control/filtarRegistros";
$route['condicao_comissionamento/p'] = "condicao_comissionamento_control";
$route['condicao_comissionamento/p/(:num)'] = "condicao_comissionamento_control";
$route['condicao_comissionamento/b'] = "condicao_comissionamento_control/filtarRegistros";
$route['condicao_comissionamento/b/(:num)'] = "condicao_comissionamento_control/filtarRegistros";



$route['configuracao'] = "configuracao_control";
$route['configuracao/recuperasenha'] = "configuracao_control/recuperasenha";





/* End of file routes.php */
/* Location: ./application/config/routes.php */