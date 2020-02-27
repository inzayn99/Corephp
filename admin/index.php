<?php
require_once '../config/configuration.php';
require_once '../config/connection.php';

$getResquestUri=isset($_GET['uri']) ? $_GET['uri'] : 'dashboard';
$getResquestUri=str_replace('.php','',$getResquestUri);
$title=ucfirst($getResquestUri);
$getResquestUri .='.php';

require_once root('admin/backend/layouts/header.php');
require_once root('admin/backend/layouts/top-time.php');
require_once root('admin/backend/layouts/aside.php');
$pagePath=root('admin/backend/pages/'. $getResquestUri);
if ((file_exists($pagePath)) && is_file($pagePath))
{
    require_once $pagePath;
}
else
{
    require_once root('admin/backend/errors/404.php');
}
require_once root('admin/backend/layouts/footer.php');

?>
