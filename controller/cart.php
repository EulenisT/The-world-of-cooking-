<?php
// créer la session
session_start();
// print_r($_POST);

// créer panier par défaut (vide, évidemment)
if(empty($_SESSION['cart']))
{
	$_SESSION['cart'] = array();
}

if( isset($_POST['action']) and $_POST['action']=="del_cart" )
{
    // on vide le panier
	$_SESSION['cart'] = array();
}

// si action = ajouter un produit au panier 
// ajouter un élément au panier 
if( isset($_POST['action']) and 
	$_POST['action']=="add" and 
	! empty($_POST['product_id']))
{
	// on ajoute product_id au panier (SESSION[cart])
	$_SESSION['cart'][] = $_POST['product_id'];

	// si l'utilisateur a cliqué deux fois sur le même produit
	// alors SESSION ne dédouble pas le nom du produit.
	$_SESSION['cart'] = array_unique($_SESSION['cart']);

	// et puis le tableau est trié
	// sort($_SESSION['cart']);
}

if( isset($_POST['action']) and
    $_POST['action']=="del" and
    ! empty($_POST['product_id']))
{
	$index = array_search($_POST['product_id'], $_SESSION['cart']);
	if( $index !== false ) unset($_SESSION['cart'][$index]);
}

// et puis le tableau est trié
sort($_SESSION['cart']);

// conversion JSON
$cart_json = json_encode($_SESSION['cart']);
echo $cart_json;