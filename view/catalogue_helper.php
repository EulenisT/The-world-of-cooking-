<?php 
require_once ('model/catalogue_data.php');

//Cela a été mis dans un commentaire "display_csv" pour
//éviter d'avoir à le consulter sur le site web. 



function display_csv()
{
?>
  <!-- <main>
    <br><br><br><br>
    id_cat;name_cat;price_cat;image_cat;title_cat;descrip_cat<br> ->
  <?php
  //$cat_a = get_catalogue();

  //foreach ( $cat_a as $art ) 
  //{
      
    //  $img = $art['img_cat'];
    //  $nom = $art['nom_cat'];
    //  $prix = $art['prix_cat'];
    //  $id_cat = $art['id_cat'];
    //  $titre = $art ['tritreH'];
    //  $descrip = $art ['desc'];  

    //  echo <<< ECHO

    //  $id_cat;$nom;$prix;$img;$titre;$descrip<br>

    //  ECHO;
  //}
  ?>
  </main> -->
  <?php

}
function html_catalogue($cart_a, $db_type, $kw, $min_price, $max_price)
{
 ?>
 <main>
 <?php
    $nb_art = get_number_articles($kw, $min_price, $max_price); 

  ?>

  <div> <br> <h4 class="affiches"> Articles affichés : <?=$nb_art?> </h4> </div>
  <div> <br> <h4 class="affiches"> Nombre d'articles dans le panier : <span id="cart_size"></span> </h4> </div>
  <ul id="cart_contents"></ul>


  <!--Bouton permettant de supprimer des éléments du panier-->

  <button class="del_cart">Effacer tout le panier</button>

  <?php


    $cat_a = get_catalogue($db_type, $kw, $min_price, $max_price);

    foreach ( $cat_a as $art ) 
    {
        
        $img = $art['img_cat'];
        $nom = $art['nom_cat'];
        $prix = $art['prix_cat'];
        $id_cat = $art['id_cat']; 
        $titre = $art ['tritreH'];
        $descrip = $art ['desc'];
        
    ?>    

    </main>
    <main>
    <div class="conteneur">
      <article class="product" id="produit<?=$id_cat?>"> 
       <div class="tableaux">   
        <div class="articles"> 
  
            <br>    
        <img src="<?=$img?>" class="img-cuisine" alt="Cuisine-à-induction"> 
        <br><br>
        <h2 class="prix"> <?=$prix?> <span class="euro">€</span> </h2>
        <form method="post"> 
        <input type="hidden" name="id_cat" value="<?=$id_cat?>" />
          <?php
          if ( in_array( $id_cat, $cart_a) )
          {
             //l'article se trouve dans le panier
            ?>
              <button name="del_from_cart" type="submit" class="button-articles">Retirer du panier</button>
            <?php
          }
          else
          {
            //l'article ne se trouve pas dans le panier
            ?>
          <button name="add_to_cart" type="submit" class="button-articles">Ajouter au panier</button>
            <?php
          }
          ?>
        </form>



        <!-- Bouton pour supprimer et/ou ajouter des éléments au panier avec AJAX -->
       
        <button class="add" id_cat="<?=$id_cat?>" type="button" >  
        <strong>  + Ajouter </strong> 
        </button>
        <button class="del" id_cat="<?=$id_cat?>" type="button">
        <strong>  - Retirer </strong> 
        </button>
        </h2>
        <br>
 
         
        <h4> <?=$titre?> </h4>
          <ul class="description"> 
          <li> <?=$nom?> </li>
          <li> <?=$descrip?> </li> 
         
        </ul>
    
        </div> 
       </div> 
      </article> 
    </div>
    </main>
     
     <?php
    }
    
}

function html_cart($cart_a,  $database_type)
{

//Voici la connexion au format XML est établie pour obtenir les données actualisées sur les taux de change. 

  $currency_xml = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
  $currency_o = simplexml_load_file($currency_xml);

  $currency_detail_o = $currency_o->Cube->Cube->Cube;  
  foreach( $currency_detail_o as $c )
{
	if( $c['currency'] == "USD" )
	{
		$rate_1 = $c['rate'];
		break;
	}
}
?>

<br><br><br>
<h4>Conversion USD/EUR</h4>

<h4 style="color : rgb(84, 84, 84);">	Conversion : 1 EUR = <?=$rate_1;?> USD<br/> </h4>

<?php


  $cat_a = get_catalogue($database_type);
  ?>
 
      <main> 
        <section id="commande">
        <div class="panier-commande-div">
        <div class="title-panier-com">
        <h2>Mon panier</h2>
        <br>
        </div>  
        <table>
      <tr>
     
        <th>Nom de l''article</th> 
        <th>ID article</th>
        <th>Article</th>
        <th>Prix</th>
        <th>Conversion</th>
        
      </tr>     

    <?php
      foreach ( $cat_a as $art)
      {
        $titre = $art ['tritreH'];
        $id_cat = $art['id_cat'];
        $nom = $art['nom_cat'];
        $prix = $art['prix_cat'];
        

        if ( in_array ( $id_cat, $cart_a))
        {
  ?>
        <tr>
          <td> <?=$titre?></td>
          <td> <?=$id_cat?></td>
          <td> <?=$nom?> </td>
          <td> <?=$prix?> <span class="euro">€</span> </td>
          <td> <?=$prix * $rate_1;?> $</td>
        <tr>
  <?php
        }
      }
  ?>
   

      <tr>
        <td colspan="3" style="background-color: rgb(220, 215, 213);"><strong>Total à facturer</strong></td> 
        <td style="background-color: rgb(38, 226, 60);"><strong></strong><span class="euro"> €</span></td>
        <td style="background-color: rgb(38, 226, 60);"><strong></strong><span class="euro"> $</span></td>
      </tr>

 <?php  
 //Voici la connexion à JSON pour placer l'annonce. 
 ?>

 </table>

</div>
</section>
</main>

<html>
<style>

.ban1 
{
  
	border:  4px solid;
	border-radius:10px;
	margin:20px;
	padding:35px;
	width:50%;
  color: #FFFFFF;
	background: linear-gradient(#FF9713, #C50000);
  font-family: "Latin Modern Roman";
}

.ban2 
{
	border:  4px solid;
	border-radius:10px;
	margin:20px;
	padding:35px;
	width:50%;
  color: #FFFFFF;
	background: linear-gradient(#C50000, #FF9713);
  font-family: "Latin Modern Roman";
}

</style>

<?php

// URL du fichier localisé sur burotix.be

$json_file_url = "http://playground.burotix.be/adv/banner_for_isfce.json";
$json_string=file_get_contents($json_file_url);
$adv_a=json_decode($json_string, true);


$adv_image 	= $adv_a['banner_4IPDW']['image']; 	// adresse de l'image 
$adv_text 	= $adv_a['banner_4IPDW']['text'];	// texte 

?>

<br><br><br><br>
<div class="panier-commande-div">
<div class="ban1"><strong>
	Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</strong>
</div>
</div>


<div class="panier-commande-div">
<div class="ban2"><strong>
	<img src="<?=$adv_image;?>" style="float:right; border-radius:10px;" />
	<?=$adv_text;?>
</strong>  
</div>
</div>



</html>

<?php
}
?>








