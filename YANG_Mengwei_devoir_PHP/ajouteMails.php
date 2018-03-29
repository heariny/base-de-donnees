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
    <h1>Ajouter mail</h1>
    <div class="line"></div>
    <?php
    echo "<p>";
    echo "Bonjour, ";
    echo $_SESSION['name'];
    $prenom=$_SESSION['name'];
    
    echo " ";
    echo $_SESSION['fname'];
    $nom=$_SESSION['fname'];
    echo "</p>";
    echo "<p>Vous pouvez ajouter votre nouveau mail</p>";
    echo "Entrez votre nouvelle adresse d'email,si entez plusieurs adresses, il faut les separer par virgule:";
    ?>
    <br><br>
    <form method="post" action="ajouteMails.php">
    <input type="text" style="width:200px;height:20px;" name="newMail">
    <br><br>
    <input type="submit" value="ok">
    </form>
    <?php
    $mail=$_POST["newMail"];
    if(strpos($mail,",")!==false){
        $temporal=explode(",",$mail);
        $mail=implode("\r\n",$temporal);
    }
    else{
        $mail=$mail;
    }
    $requete="SELECT * FROM identification WHERE nom='$nom'and prenom='$prenom'";
    $reponse=$bdd->prepare($requete) or die(print_r($bdd->errorInfo()));
    $reponse ->execute();
    $results=$reponse -> fetch();
    $id=$results['id'];

    
    $requete="SELECT * FROM mail WHERE id_etudiant='$id'";
    $reponse=$bdd->prepare($requete) or die(print_r($bdd->errorInfo()));
    $reponse ->execute();
    $results=$reponse -> fetch();
    $oldMail=$results['adresse'];
    $new_mail="";
    $new_mail=$oldMail.$mail."\r\n";
    
    try{
    $sql="UPDATE mail SET adresse='$new_mail' WHERE id_etudiant='$id'";
    $statement=$bdd->prepare($sql);
    $statement->execute();
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }

 /*verify  
    $sql="SELECT adresse FROM mail WHERE id_etudiant='$id' ";
    $reponse=$bdd->prepare($requete) or die(print_r($bdd->errorInfo()));
    $reponse ->execute();
    $results=$reponse -> fetch();
    $ad=$results['adresse'];
    echo $ad;
  */
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