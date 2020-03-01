<?php
ob_start();
session_start();
if (!function_exists('root'))
{
    function root($path='')
    {
      $path=trim($path,'/');
     return dirname(dirname( __FILE__)).'/'.$path;

    }
}

if (!function_exists('url'))
{
    function url($uri='')
    {
      $uri=trim($uri,'/');
    $serverName=$_SERVER['SERVER_NAME'];
    return 'http://'.$serverName.':8888'.'/corephp/'.$uri;



    }
}

if (!function_exists('admin_url'))
{
    function admin_url($uri='')
    {
        $uri=trim($uri,'/');
        return url('admin/'.$uri);
    }
}

if (!function_exists('redirect_back'))
{
    function redirect_back()
    {
       $referer=$_SERVER['HTTP_REFERER'];
        if (isset($referer))
        {
            header('Location:'.$referer);
            exit();
        }
    }
}

if (!function_exists('redirect_to'))
{
    function redirect_to($path='')
    {
      $path=trim($path,'/');
      $redirectTo=url($path);
      header('Location:'.$redirectTo);
   }
}

if (!function_exists('messages'))
{
    function messages()
    {
        if (isset($_SESSION['success']))
        {
            $class='alert alert-success';
            $message=$_SESSION['success'];
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error']))
        {
            $class='alert alert-danger';
            $message=$_SESSION['error'];
            unset($_SESSION['error']);
        }
        $output ='';
        if (isset($message))
        {
           $output.="<div class ='$class'>";
           $output.= $message;
           $output.="</div>";
        }
        return $output;
    }
}




?>