<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
<style>
body{  
    margin:0;  
    padding:0;  
    width:100%;  
    height:100%; 
    text-align: center; 
    background: #f0f3f4;
}  
div{  
   position:absolute;  
   top:50%;  
   left:50%;  
   margin-top:-250px;  
   margin-left:-250px;  
    /*此时宽和高都要固定*/  
    width:500px;  
    height:300px;  
    border-style: solid;
    border-color:  #34495e;
    text-align:center;
}
</style>
</head>
<body>
<!--connection-->
<?php
$connextion=new PDO('mysql:host=localhost;dbname=gestiondefi2017', 'root', 'root');
try{
    $bdd=new PDO('mysql:host=localhost;dbname=gestiondefi2017', 'root', 'root');
}
catch(Exception $e){
    die('Erreur:'.$e->getMessage()); 
}
?>
<div id="wrapper">
<h3>Identification</h3>
<?php

$sql='SELECT nom,prenom,pass FROM identification';
$reponse= $bdd->query($sql);
$listEtudiant=array();
while($donnees=$reponse->fetch()){
    $name=$donnees['prenom'].'_'.$donnees['nom'];
    array_push($listEtudiant,$name);
}

$titre="etudiantsDEFI";
sort($listEtudiant);
function roulant($tab,$content){
    echo "<SELECT name=\"$content\">";
    foreach($tab as $value){
        echo "<OPTION value=\"$value\">$value</OPTION>";
    }
    echo "</SELECT>";
}



echo "Nom(tous en majuscule): ";
echo "<form method=\"post\" action=\"variable.php\">";
echo "<input type=\"text\" name=\"nom\">";
echo "</form>";
echo "Prenom(Commence par lettre en majuscule):";
echo "<form method=\"post\" action=\"variable.php\">";
echo "<input type=\"text\" name=\"prenom\">";
echo "</form>";



echo "<b>Ou</b>";
echo "<br/>";
echo "Choisissez votre nom et prenom: ";


echo "<form method=\"post\" action=\"variable.php\">";
roulant($listEtudiant,$titre);
echo "<p>Entrez votre mot de pass:<input type=\"password\" name=\"mdpass\"></p>";
echo "<input type=\"submit\" value=\"ok\">";
echo "</form>";

?>
</div>
</body>
</html>