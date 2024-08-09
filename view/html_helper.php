<?php 
function html_start($theme="")
{ 
    ?>  
    
    <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'univers de la cuisine</title>
    <link rel="stylesheet" href="view/theme/<?=$theme?>.css">
    <link rel="stylesheet" href="view/css/main.css?uuid=<?php echo uniqid();?>">

<!--JQUERY-->

 <script src="https://code.jquery.com/jquery-3.4.1.js"   
 integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
 crossorigin="anonymous" ></script>

<script src="./view/js/detail.js" ></script>
<script src="./view/js/cart.js" ></script>

</head>

<!--Voici le code qui aurait dû se trouver dans le fichier detail.js-->
<!--Cette fonction permet de faire apparaître et disparaître les commentaires 
sur certains titres lorsque l'on retire la souris.-->

<script lang="JavaScript">

    $(document).ready(function() {
    $('.titresform').on('mouseover', function() {
    $(this).find('.descrip').show();
  });

    $('.titresform').on('mouseout', function() {
    $(this).find('.descrip').hide();
  });
});

</script>  

<body>


    <?php 
}

//HEADER

function html_header($form_login=true,  $fullname="")
{
    ?>

<div class="header-div">  
<header>   

  
  <nav>
    
    <div class="wrapper">
  
    <ul>


      <div class="title-index">  
         <a href="index.php"><h1>L'univers de la cuisine<span class="point-1">.</span></h1></a>
      </div> 


     <?php
      $menu_a=get_menu();

      foreach ($menu_a as $menu_item)
       {
     ?>    

       <div class="list-1">

        <li><a href="./index.php?page=<?= $menu_item[1]?>" class="link-header" target="_self"><?= $menu_item[0]?></a></li>

        </div> 
       
    <?php                             
       }
      

       if ($form_login)
       {

        html_form_login();
        
       }
       else
       {
       
        echo $fullname;
        html_form_logout();
      
       }
  
       ?> 

      </ul>
    </div>
 </nav>  
</header>    
</div>    

    <?php
}

//MENU

function get_menu()
{
return [
  ["Panier" , "cart"],
  ["À propos" , "about"],
  ["CSV" , "csv"],
];
}

function html_display_page($page)
{
  require_once("./view/media/$page.html");
}


function html_nav($display_filter=false)
{
    ?>
  <div class="form-body">
  <?php
  if ($display_filter){
  ?>
  <div class="conten">
  
  <form method="post">
    
          <div class="formulaire"> 

       <!--Structure pour le changement de la couleur d'arrière-plan du site web-->

       <div class="boxform">
       <div class="choix">


       <label for="theme" >
    <div class="titresform">
       <h5>Thème</h5></label>
    <div class="descrip">
       <p>Vous pouvez ici modifier la</p>
       <p>couleur de l'arrière-plan.</p>
    </div>
    </div>
       <select name="theme"  class="recherche">

  
           <option value=""></option>
           <option value="hotpink">HotPink</option>
           <option value="tan">Tan</option>
           <option value="thistle">Thistle</option>
           <option value="white">White</option>
       </select>
           <button name="go_color" class="bouton-1">Colorier</button>

           </div>
           </div>

         <!-- Structure de recherche de produits  -->  


   <div class="boxform">
   <div class="titresform">
         <h5  style="padding-bottom: 6px;"> RECHERCHER </h5>
   <div class="descrip">
    <p>Dans cet espace, vous pouvez rechercher un</p>
    <p>produit spécifique, en utilisant des mots clés.</p>
   </div>
   </div>
         <div class="choix"> 
          <form method="post">
            <input type="text" name="search" class="recherche" placeholder="L'univers de la cuisine">
            <button name="go_search" type="submit" class="bouton-1"> Submit </button>
          </form>
         </div> 
          </div>           
           
          <!-- Structure d'estimation du prix d'un produit  -->  

          <div class="boxprix">   
          <div class="boxform"> 
          <div class="choix">
          <form method="post">
    <div class="titresform">  
          <h5 style="padding-bottom: 6px;"> Prix de </h5> 
    <div class="descrip">
    <p>Ici, vous pouvez rechercher un produit dont </p>
    <p>le prix varie entre deux prix.</p>
    </div>
    </div>
          <input type="number" name="min_price"  class="recherche" placeholder="0">
          <span class="euro"> à </span>  <input type="number" name="max_price" class="recherche" placeholder="1000"><span class="euro">€</span> 
            <button name="go_search" type="submit" class="bouton-1"> Submit </button>
          </form>
          </div>
          </div>
          </div>
         
          </div>                       
          </form>
  
        
    <?php

}}



//FOOTER


function html_footer()
 {

    ?>

<div class="footer-contact">
    <section id="Identifiez-vous">

    <div class="wrapper">

      <h3>Contactez-nous</h3>
                <p style="margin: 5px; "> Chez L'univers de la cuisine nous savons qu'une cuisine c'est pour la vie.
                    C'est pourquoi nous mettons un point d'honneur à prendre 
                    en compte chacune de vos attentes pour vous accompagner 
                    dans la création, la rénovation ou l'achat d'articles
                    pour votre cuisine. </p>
                    
                <form>
                    <label for="name" class="contact">Nom</label>
                    <input type="text" id="name" placeholder="Votre nom" class="recherche">

                    <label for="email" class="contact">Email</label>
                    <input type="text" id="email" placeholder="Votre email" class="recherche">

                    <input type="submit" value="OK" class="button-2">
                </form>

    </div>

    </section>
 
  
    <footer>

        <div class="wrapper">

          <div class="copyright">
          <h1>L'univers de la cuisine<span class="point-1">.</span></h1>
               <p>Copyright © Tous droits réservés.</p></div>

        </div>

    </footer>
  </div>



    <?php

 }

 function html_stop()
 {
    ?>

        </body>
        </html>

    <?php

 }