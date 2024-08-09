<?php

session_start();

require_once ('view/catalogue_helper.php');
require_once ('view/html_helper.php');
require_once('model/user_data.php');
require_once('view/user_helper.php');

//param
$database_type = "mysql";// "hard-coded"; 

//COOKIE
if(isset($_COOKIE['id'])) 
{
    
    $form_login = true; 
}
else
{
    unset($_SESSION['loginS']); 
    $form_login = false;
}

if(isset($_POST['logout'] ))
{
	// l'utilisateur veut se délogguer
    
	setcookie("id", "", 1 ); 
    $form_login = false;
}

if( ! empty($_POST['login']))
{
	// l'utilisateur est en train de s'identifier

	$_COOKIE['id'] = $_POST['login'];
	$expire = time() + 30; 
	setcookie( "id", $_POST['login'], $expire );
    $form_login= true;
}

//Fin du cookie

if ( ! isset($_SESSION["theme"])) $_SESSION["theme"] = "";
if(isset($_POST["go_color"]))
{
    $_SESSION["theme"] = $_POST["theme"];
}


html_start($_SESSION["theme"]);

//Début du login

if (isset($_POST['logout']))
{
    session_unset();
    $form_login = true;
}
elseif (isset($_SESSION['loginS']) )
{
    $form_login=false;     
}
elseif (isset($_POST['login']) )
{
    list( $is_valid, $fullname ) = check_login ($database_type, $_POST['login'], $_POST['password']);
    if ( $is_valid)
    {
        $_SESSION['loginS'] = $_POST['login'];
        $_SESSION['fullname'] = $fullname;
        $form_login=false;
    }
    else {
        $form_login=true;
    }
}
else
{
$form_login=true;
}


if ( ! isset ($_SESSION['fullname'])) $_SESSION ['fullname'] = "";


html_header($form_login,  $_SESSION['fullname']);

//Fin du login

if ( ! isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if (isset($_POST['add_to_cart']))
{
   //ajouter au panier
    $_SESSION['cart'][] = $_POST['id_cat'];
    
    sort(array: $_SESSION['cart']);
    $_SESSION['cart'] = array_unique($_SESSION['cart']);
}

if (isset($_POST['del_from_cart']))
{
    if (($key = array_search( $_POST['id_cat'], $_SESSION['cart'] )) !== false)
    {
        unset($_SESSION['cart'][$key]);
    }
}

//var_dump($_POST);
//traiment des mots clés de recherche 
$kw = false;
$min_price= 0;
$max_price= 1000;
if(isset($_POST['go_search']))
{
   if (!empty($_POST['search']))
   {
    $kw = $_POST['search'];
   }
   if (!empty ($_POST['min_price']))
   {
    $min_price = $_POST['min_price'];
   }
   if (!empty ($_POST['max_price']))
   {
    $max_price = $_POST['max_price'];
   }
}

//MENU

if(! isset($_GET['page'])) $_GET['page'] = "home";
switch($_GET['page'])
{
    case "csv":
        display_csv();
        break;
    case "home":
        html_nav(display_filter:true); 
        html_catalogue($_SESSION['cart'], $database_type, $kw, $min_price, $max_price);
        break;
    case "cart":
        html_nav(display_filter:false);
        html_cart($_SESSION['cart'], $database_type);
        break; 
    default:
        html_nav(display_filter:false); 
        html_display_page( $_GET['page']);
        break;
}


html_footer();

html_stop();





  
