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
$route['empresa/salvar'] = "empresa_control/salvar";
$route['empresa/editar'] = "empresa_control/editar";


$route['usuario'] = "usuario_control";
$route['usuario/salvar'] = "usuario_control/salvar";
$route['usuario/editar'] = "usuario_control/editar";
$route['usuario/ativar'] = "usuario_control/ativar";

$route['login'] = "login_control";
$route['login/buscarempresa'] = "login_control/buscarEmpresa";
$route['login/entrar'] = "login_control/entrar";
$route['login/sair'] = "login_control/sair";

$route['seguradora'] = "seguradora_control";

$route['configuracao'] = "configuracao_control";
$route['configuracao/recuperasenha'] = "configuracao_control/recuperasenha";





/* End of file routes.php */
/* Location: ./application/config/routes.php */