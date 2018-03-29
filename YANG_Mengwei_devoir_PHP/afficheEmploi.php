<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>DEFI</title>
<link rel="shortcut icon" type="image/x-icon" href="style/images/学校.png" />
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Amaranth:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="style/js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="style/js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="style/js/jquery.jcarousel.js"></script>
<script type="text/javascript" src="style/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="style/js/carousel.js"></script>
<script type="text/javascript" src="style/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="style/js/jquery.masonry.min.js"></script>
<script type="text/javascript" src="style/js/jquery.slickforms.js"></script>
</head>
<body>
<!--Connection-->
<?php
$connextion=new PDO('mysql:host=localhost;dbname=gestiondefi2017', 'root', 'root');
try{
	$bdd=new PDO('mysql:host=localhost;dbname=gestiondefi2017', 'root', 'root');
}
catch(Exception $e){
	die('Erreur:'.$e->getMessage()); 
}
?>

<!-- Begin Wrapper -->
<div id="wrapper">
	<!-- Begin Sidebar -->
	<div id="sidebar">
		 <div id="logo"><a href="index.html"><img src="style/images/logo.png" height="90%" width="90%" /></a></div>
		 
	<!-- Begin Menu -->
    <div id="menu" class="menu-v">
	<?php
	$reponse= $bdd->query('SELECT * FROM menu') or die( print_r($bdd->errorInfo()));
	$reponse ->execute();
	$rows=$reponse->fetchAll(PDO::FETCH_ASSOC);
    echo "<ul>";
    echo "<li><a href=\"pageAccueil.php\">Accueil</a></li>";
	foreach($rows as $row){
		echo "<li>";
		echo "<a href=\"";
		echo $row['script'];
		echo " \"> ";
		echo $row['item_menu'];
		echo "</a>";
		echo "</li>";
	}
	echo "</ul>";

	?>
    </div>
    <!-- End Menu -->
    
	</div>

	
	<!-- Begin Content -->
	<div id="content">
    <h1>Liste de mails</h1>
    <div class="line"></div>

<?php
$table=$bdd->prepare("SELECT * FROM emploi");
$table->execute();
$rows=$table->fetchAll(PDO::FETCH_ASSOC);
$infoArray=array();
foreach($rows as $row){
    $laDate=end(explode("-",$row['date']));
    if($laDate[0]==0){
        $laDate=$laDate[1];
    }else{
        $laDate=$laDate;
    }
    
    $theDat=$row['jour'];
    $jour=$bdd->prepare("SELECT * FROM jours_semaine WHERE id='$theDat' ") or die(print_r($bdd->errorInfo()));
    $jour->execute();
    $jour=$jour -> fetch();
    $leJour=$jour["jour"];

    $lheure=$row['heure'];
    $laDuree=$row['duree'][0];
    
    $theClass=$row['id_ec'];
    $cours=$bdd->prepare("SELECT * FROM enseignements WHERE id='$theClass' ") or die(print_r($bdd->errorInfo()));
    $cours->execute();
    $cours=$cours ->fetch();
    $leCours=$cours["intitule"];

    $theTeacher=$row['id_enseignant'];
    $enseignants=$bdd->prepare("SELECT * FROM enseignants WHERE id='$theTeacher' ") or die(print_r($bdd->errorInfo()));
    $enseignants->execute();
    $enseignants=$enseignants->fetch();
    $lenseignant=$enseignants["nom"];

    $info=$leJour."_".$lheure."_".$laDuree."_".$leCours."_".$lenseignant;
    
    if(array_key_exists($laDate,$infoArray) ){
        $infoArray["$laDate"]=$infoArray[$laDate]."|".$info;
    }else{
        $infoArray["$laDate"]=$info;
    }
    }


echo "<table>";
echo "<thead>";
echo "<th colspan=10><h4>L'emploi du temps de DEFI 2017</h4></th>";
echo "<tr class=\"caption\">";
echo "<th>Mois</th>";
echo "<th>Date</th>";
echo "<th>Jour</th>";
echo "<th>9h30 à 10h30</th>";
echo "<th>10h30 à 11h30</th>";
echo "<th>11h30 à 12h30</th>";
echo "<th>12h30 à 13h30</th>";
echo "<th>13h30 à 14h30</th>";
echo "<th>14h30 à 15h30</th>";
echo "<th>15h30 à 16h30</th>";
echo "</tr>";
echo "</thead>";
foreach($infoArray as $key=>$value){
    echo "<tbody>";
    echo "<tr>";
    echo "<td>Décembre</td>";
    echo "<td>$key</td>";
    if (strpos($value, '|') !== false) {
        $cours=explode("|",$value);
        $cours_1=$cours[0];
        $cours_2=$cours[1];
        $info_cours_1=explode("_",$cours_1);
        $info_cours_2=explode("_",$cours_2);
        echo "<td>$info_cours_1[0]</td>";
        echo "<td colspan=$info_cours_1[2]>Cours: $info_cours_1[3]"."<br>"."Enseignant: $info_cours_1[4]</td>";
        echo "<td></td>";
        echo "<td colspan=$info_cours_2[2]>Cours: $info_cours_2[3]"."<br>"."Enseignant: $info_cours_2[4]</td>";
    }
    else{
        $info_cours=explode("_",$value);
        echo "<td>$info_cours[0]</td>";
        echo "<td colspan=$info_cours[2]>Cours: $info_cours[3]"."<br>"."Enseignant: $info_cours[4]</td>";
        echo "<td></td>";
    }
    echo "</tr>"; 
    echo "</tbody>";
}
echo "</table>";


?>
</div>
<!-- End Wrapper -->
<div class="clear"></div>
<script type="text/javascript" src="style/js/scripts.js"></script>
<!--[if !IE]> -->
<script type="text/javascript" src="style/js/jquery.corner.js"></script>
<!-- <![endif]-->
</body>

</html>

