/*
    *  Mise à jour du panier à l'écran
    *  Mise à jour du nombre d'articles dans le panier
    *  Activation/désactivation des boutons ajax "add" et "del"
    */
function display_cart(cart_data)
{
    // alert(cart_data);
    // on efface le panier actuel
    $("ul#cart_contents").html("");

    // on réinitialise les boutons "add" à "enabled"
    $("button.add").attr('disabled', false);
    // on réinitialise les boutons "del" à "disabled"
    $("button.del").attr('disabled', true);

    // on recrée les balises <li>
    // boucle sur le panier avec string et méthode .html()
    s = '';
    $.each(cart_data, function( i, v ) {
    // on construit la liste <li>
    s += "<li>" + v + "</li>"

    // on désactive le bouton "ajouter"
    var sel = "button.add[id_cat=\"" + v + "\"]";
    console.log(sel);
    $(sel).attr('disabled', true);

    // on active le bouton "retirer"
    var sel = "button.del[id_cat=\"" + v + "\"]";
    console.log(sel);
    $(sel).attr('disabled', false);

});
    $("ul#cart_contents").html(s);

    // on compte le nombre d'éléments dans le panier et on affiche ce 
    // nombre à l'endroit adéquant.   

    $("span#cart_size").html(cart_data.length);
}



/*
* au chargement de la page
*/
$( function() {

// URL du serveur
var server_script = 'controller/cart.php';


// évènement associé aux boutons
$('article button.add').click(function() {
// alert('button clicked' + $(this).attr('for') );
// préparation de la requête AJAX
var param = {
    product_id : $(this).attr('id_cat') ,
    action:"add"
};
// envoi de la requête AJAX
$.post( server_script, param, display_cart, "json" );
// post-traitement

});

$('button.del').click(function() {

var param = {
product_id : $(this).attr('id_cat') ,
action:"del"
};
$.post( server_script, param, display_cart, "json" );
});

// évènement : effacer tout le panier
$('button.del_cart').click(function() {
var param = {
action:"del_cart"
};
$.post( server_script, param, display_cart, "json" );

    });

    // afficher le panier au chargement de la page
$.post( server_script, display_cart, "json" );

});
