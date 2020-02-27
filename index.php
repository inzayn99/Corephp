<?php
 require_once './config/configuration.php';
require_once './config/connection.php';

$getResquestUri=isset($_GET['uri']) ? $_GET['uri'] : 'home';
$getResquestUri=str_replace('.php','',$getResquestUri);
$title=ucfirst($getResquestUri);
$getResquestUri .='.php';

require_once root('frontend/layouts/header.php');
require_once root('frontend/layouts/top-header.php');
require_once root('frontend/layouts/menu.php');
require_once root('frontend/layouts/top-news.php');
$pagePath=root('frontend/pages/'. $getResquestUri);
if ((file_exists($pagePath)) && is_file($pagePath))
{
 require_once $pagePath;
}
else
{
 require_once root('frontend/errors/404.php');
}
require_once root('frontend/layouts/footer.php');

?>
