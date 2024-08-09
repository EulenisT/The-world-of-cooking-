<?php

//Ces mêmes utilisateurs peuvent être trouvés dans la base de données

function get_user()
{
    return[
        ['admin' , 'Administrator', 'admin'],
        ['user' , 'User', 'user'],
        ['Arthur' , 'Administrator', 'king'],
        ['Joseph' , 'User', 'marie'],
    
    ];
}


function  check_login($db_type, $login, $password)
{
    switch ($db_type){
        case "hard-coded":
            return check_login_hc($login, $password);
            break;
        case "mysql":
            return check_login_db($login, $password);
            break;
    }
}


//Check-login hard-code

function check_login_hc($login, $password)
{
    $user_a = get_user();

  
    foreach($user_a as $user_item)
    {
        if ( $user_item[0] == $login and $user_item[2] == $password)
        {
            //user trouvé
            return [ true, $user_item[1] ];
        }
        
    }
            //user non trouvé
            return [ false , false ];
        
}

//Check-login lié à la base de données 

function check_login_db($login, $password)
{

    $pdo = db_connect();

    $sql = <<< SQL
       
    SELECT COUNT(*) FROM `t_user`
    WHERE name_user = :login
    AND password_user = :password
    
SQL;
    $stmt = $pdo->prepare($sql);

    $param = [
        'login' => $login,
        'password' => $password    
        ];

    $stmt->execute($param);
    $row = $stmt->fetch();
    $is_logged = $row[0];
    return $is_logged == 1 ? [true, $login] : [false, false] ; 

}

?>