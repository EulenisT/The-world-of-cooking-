<?php

function html_form_login()
{
?>
    <form method="post">
    <div class="wrapper">
    <div class="list-1">
        <label class="contact"> Votre login : </label>
        <input name="login" type="text" placeholder="votre login" class="recherche">
        <input name="password" type="password" placeholder="mot de passe" class="recherche">
        <button name="loginS" type="submit" class="button-2">Connexion</button> 
    </div>   
    </div>    
    </form>  

<!-- Commentaire lorsque l'utilisateur n'est pas connecté -->       

    <div class="bonjour"> 
       <p>Utilisateur non identifié</p>
    </div>

<?php
}

function html_form_logout()
{
?>
    <form method="post">
    <div class="wrapper">
    <div class="list-1">

         <button name="logout" type="submit" class="button-2">Logout</button> 
    </div>   
    </div> 
    </form>

<!-- Commentaire lorsque l'utilisateur est connecté -->    

    <div class="bonjour"> 
      <p> Bonjour. Vous êtes identifié comme: <?= $_COOKIE['id']?> </p>
    </div>

<?php
}
?>