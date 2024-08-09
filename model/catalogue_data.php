
<?php
require_once "./model/db_helper.php";


function get_catalogue($db_type, $kw="", $min_price=0, $max_price=1000)
{
    switch ($db_type){
        case "hard-coded":
            return get_catalogue_hc();
            break;
        case "mysql":
            return get_catalogue_db($kw, $min_price, $max_price);
            break;
    }
}

//Get-number-articles lié à la base de données 
//Montre le nombre d'articles entre le produit recherché et le prix souhaité par l'acheteur. 

function get_number_articles($kw,  $min_price, $max_price)

{
    $pdo = db_connect();

     
    if($kw)
    {
        $where = "title_cat LIKE :kw"; 
        
    }
    
    else 
    {
        $where = " true";     
        $param = [];
    }

    $sql = <<< SQL
        SELECT count(*) as c   
        FROM t_catalogue 
        WHERE $where
        AND price_cat between :min_price AND :max_price
       
    
SQL;
    $stmt = $pdo->prepare($sql);

    $param = [
        'min_price' => $min_price,
        'max_price' => $max_price    
        ];
        if($kw)
        {
            $param ['kw'] = "%$kw%";
        }
    

    $stmt->execute($param);
    $row = $stmt->fetch();
    $nb = $row['c'];
    return $nb;
}

//Get-catalogue lié à la base de données

function get_catalogue_db($kw=false, $min_price=0, $max_price=1000)
{
    $pdo = db_connect();
    
    if($kw)
    {
        $where = " title_cat LIKE :kw"; 
    
    }
    
    else 
    {
        $where = " true";   
        $param = [];
    }
    
    $sql = <<< SQL
    SELECT 
        *,
        image_cat as img_cat,
        name_cat as nom_cat,
        price_cat as prix_cat,
        title_cat as tritreH,
        descrip_cat as 'desc'
        
    FROM t_catalogue 
    WHERE $where
    AND price_cat between :min_price AND :max_price
    ORDER BY price_cat DESC
SQL;
    $stmt = $pdo->prepare($sql);
    
    $param = [
    'min_price' => $min_price,
    'max_price' => $max_price    
    ];
    if($kw)
    {
        $param ['kw'] = "%$kw%";
    }

    $stmt->execute($param);
    $cat_a = [];
    while ( $row = $stmt->fetch())
    {
        $cat_a[] = $row;
        
    }

    return $cat_a;
}


//Get-catalogue hard-code

function get_catalogue_hc()
{
    $article1_a = [
        'id_cat' => 1,
        'nom_cat' => 'article n°1',
        'prix_cat' => 250.00,
        'img_cat' => 'Model/media/cuisineàinduction(1).jpg',
        'tritreH' => 'Plaque de cuisson à induction',
        'desc'=> 'Affichage de la chaleur: oui, chauffe rapide: oui,
         sécurité enfants: oui'
        ];

        $article2_a = [
            'id_cat' => 2,
            'nom_cat' => 'article n°2',
            'prix_cat' => 300.00,
            'img_cat' => 'Model/media/cuisineàinduction(2).jpg',
            'tritreH' => 'Plaque de cuisson à induction',
            'desc'=> 'Affichage de la chaleur: oui, chauffe rapide: oui,
             sécurité enfants: oui'
            ];
            
            $article3_a = [
                'id_cat' => 3,
                'nom_cat' => 'article n°3',
                'prix_cat' => 315.00,
                'img_cat' => 'Model/media/cuisineàinduction(3).jpg',
                'tritreH' => 'Plaque de cuisson à induction',
                'desc'=> 'Affichage de la chaleur: oui, chauffe rapide: oui,
                 sécurité enfants: oui'
                ];    
            
                $article4_a = [
                    'id_cat' => 4,
                    'nom_cat' => 'article n°4',
                    'prix_cat' => 400.00,
                    'img_cat' => 'Model/media/cuisineàinduction(4).jpg',
                    'tritreH' => 'Plaque de cuisson à induction',
                    'desc'=> 'Affichage de la chaleur: oui, chauffe rapide: oui,
                    sécurité enfants: oui'
                    ]; 
                    
                    $article5_a = [
                        'id_cat' => 5,
                        'nom_cat' => 'article n°5',
                        'prix_cat' => 148.00,
                        'img_cat' => 'Model/media/Batterie de cuisine (1).jpg',
                        'tritreH' => 'Batterie cuisine rouge ',
                        'desc'=> 'Empilables pour un rangement optimal
                        Le revêtement anti-adhésif titanium
                        Poignée 100% sûr'
                        ];   
                        
                        $article6_a = [
                            'id_cat' => 6,
                            'nom_cat' => 'article n°6',
                            'prix_cat' => 193.00,
                            'img_cat' => 'Model/media/Batterie de cuisine (2).jpg',
                            'tritreH' => 'Batterie cuisine noire ',
                            'desc'=> 'Aluminium forgé
                            Anti-adhésif écologique marbre
                            Convient à tous types de cuisines
                            Design exclusif en métal
                            Peut passer au lave-vaisselle'
                            
                            ];   

                            $article7_a = [
                                'id_cat' => 7,
                                'nom_cat' => 'article n°7',
                                'prix_cat' => 160.00,
                                'img_cat' => 'Model/media/Batterie de cuisine (3).jpg',
                                'tritreH' => 'Batterie cuisine noire ',
                                'desc'=> 'Aluminium forgé
                                Anti-adhésif écologique marbre
                                Convient à tous types de cuisines
                                Design exclusif en métal
                                Peut passer au lave-vaisselle'
                                ];   
                                $article8_a = [
                                    'id_cat' => 8,
                                    'nom_cat' => 'article n°8',
                                    'prix_cat' => 120.00,
                                    'img_cat' => 'Model/media/Batterie de cuisine (4).jpg',
                                    'tritreH' => 'Batterie cuisine noire ',
                                    'desc'=> 'Empilables pour un rangement optimal
                                    Le revêtement anti-adhésif titanium
                                    Poignée 100% sûr'
                                    ];   
                                    $article9_a = [
                                        'id_cat' => 9,
                                        'nom_cat' => 'article n°9',
                                        'prix_cat' => 43.00,
                                        'img_cat' => 'Model/media/poêle(1).jpg',
                                        'tritreH' => 'Poêle ',
                                        'desc'=> 'Poêle avec extra résistant
                                        Base à induction robuste avec plaque en acier inoxydable'
                                        ];   
          
                                        $article10_a = [
                                            'id_cat' => 10,
                                            'nom_cat' => 'article n°10',
                                            'prix_cat' => 37.00,
                                            'img_cat' => 'Model/media/poêle(2).jpg',
                                            'tritreH' => 'Poêle ',
                                            'desc'=> 'Poêle avec extra résistant
                                            Base à induction robuste avec plaque en acier inoxydable'
                                            ];   
                                            $article11_a = [
                                                'id_cat' => 11,
                                                'nom_cat' => 'article n°11',
                                                'prix_cat' => 30.00,
                                                'img_cat' => 'Model/media/poêle(3).jpg',
                                                'tritreH' => 'Poêle ',
                                                'desc'=> 'Poêle avec extra résistant
                                                Base à induction robuste avec plaque en acier inoxydable'
                                                ];   
                                                $article12_a = [
                                                    'id_cat' => 12,
                                                    'nom_cat' => 'article n°12',
                                                    'prix_cat' => 40.00,
                                                    'img_cat' => 'Model/media/poêle(4).jpg',
                                                    'tritreH' => 'Poêle ',
                                                    'desc'=> 'Poêle avec extra résistant
                                                    Base à induction robuste avec plaque en acier inoxydable'
                                                    ];   
                                          
                                                    $article13_a = [
                                                        'id_cat' => 13,
                                                        'nom_cat' => 'article n°13',
                                                        'prix_cat' => 35.00,
                                                        'img_cat' => 'Model/media/poêleàcrêpe(1).jpg',
                                                        'tritreH' => 'Poêle ',
                                                        'desc'=> 'Pour des crêpes parfaites.
                                                        Ne colle pas, ne brûle pas
                                                        Convient à tous les types de cuisinières
                                                        Pour un dessert sucré savoureux'
                                                        ];   
                                              
                                                        $article14_a = [
                                                            'id_cat' => 14,
                                                            'nom_cat' => 'article n°14',
                                                            'prix_cat' => 20.00,
                                                            'img_cat' => 'Model/media/poêleàcrêpe(2).jpg',
                                                            'tritreH' => 'Poêle rouge ',
                                                            'desc'=> 'Pour des crêpes parfaites.
                                                            Ne colle pas, ne brûle pas
                                                            Convient à tous les types de cuisinières
                                                            Pour un dessert sucré savoureux'
                                                            ];   
                                                            $article15_a = [
                                                                'id_cat' => 15,
                                                                'nom_cat' => 'article n°15',
                                                                'prix_cat' => 18.00,
                                                                'img_cat' => 'Model/media/poêleàcrêpe(3).jpg',
                                                                'tritreH' => 'Poêle ',
                                                                'desc'=> 'Pour des crêpes parfaites.
                                                                Ne colle pas, ne brûle pas
                                                                Convient à tous les types de cuisinières
                                                                Pour un dessert sucré savoureux'
                                                                ];   
                                  
                                      
          


        return [
            $article1_a,
            $article2_a,
            $article3_a,
            $article4_a,
            $article5_a,
            $article6_a,
            $article7_a,
            $article8_a,
            $article9_a,
            $article10_a,
            $article11_a,
            $article12_a,
            $article13_a,
            $article14_a,
            $article15_a,
            
        ];
}

?>

