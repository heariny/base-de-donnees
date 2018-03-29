<!DOCTYPE HTML>
<?php session_start();  ?>
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

<html>
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


<!-- Begin Wrapper -->
<div id="wrapper">
	<!-- Begin Sidebar -->
	<div id="sidebar">
		 <div id="logo"><img src="style/images/logo.png" height="90%" width="90%"/></div>
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
  <h1>Accueil</h1>
  <div class="line"></div>
  <?php
  if (empty($_SESSION['name']) ||empty($_SESSION['fname'])||empty($_SESSION['passWord'])){
	  echo "Vous n'etes pas connecte";
	  echo "<br/>";
	  echo "<a href=\"connection.php\">Retourner au page de connection</a>";
  }
  else{
  echo "<p>Bonjour, ";
  echo $_SESSION['name'];
  echo " ";
  echo $_SESSION['fname'].".</p>";
  echo "<p>";
  echo "Aujourd'hui c'est le " . date("d/m/Y") ."<br>";
  echo "</p>";
  echo "<p>";
  echo "Sur ce site, vous pouvez: ";
  echo "</p>";
  echo "<ol>";
  echo "<li><a href=\"afficheEmploi.php\">";
  echo "Consultez l'emploi du temps du Décembre 2017";
  echo "</a></li>";
  echo "<li><a href=\"afficheMails.php\">";
  echo "Consultez la liste des mails de la promotion";
  echo "</li>";
  echo "<li><a href=\"ajouteMails.php\">";
  echo "Ajoutez votre nouvelle adresse de mail dans la base de données";
  echo "</li>";
  echo "</ol>";
}
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