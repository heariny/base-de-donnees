<?php
session_start();


?>

<html>
<body>
<?php
$connextion=new PDO('mysql:host=localhost;dbname=gestiondefi2017', 'root', 'root');
try{
	$bdd=new PDO('mysql:host=localhost;dbname=gestiondefi2017', 'root', 'root');
}
catch(Exception $e){
	die('Erreur:'.$e->getMessage()); 
}
?>
<?php
$enterNom=$_POST["nom"];
$enterPrenom=$_POST["prenom"];

if (empty($enterNom)||empty($enterPrenom)){
    $choose=$_POST["etudiantsDEFI"];
    $chooseArray=explode("_",$choose);
    $chooseNom=end($chooseArray);
    $choosePrenom=$chooseArray[0];

}
else{
    $chooseNom=$enterNom;
    $choosePrenom=$enterPrenom;
}

$mdpass=$_POST["mdpass"];
$requete="SELECT * FROM identification WHERE nom='$chooseNom'and prenom='$choosePrenom'and pass='$mdpass'";
$reponse=$bdd->prepare($requete) or die(print_r($bdd->errorInfo()));
$reponse ->execute();
$results=$reponse -> fetch();


$_SESSION['fname']=$chooseNom;
$_SESSION['name']=$choosePrenom;
$_SESSION['passWord']=$mdpass;

if($results==null){ 
    echo "<script type='text/javascript'>";  
    echo "window.location.href='connection_echoue.php'";  
    echo "</script>";     
}else{
    echo "<script type='text/javascript'>";  
    echo "window.location.href='pageAccueil.php'";  
    echo "</script>"; 
}

?>

</body>
</html>