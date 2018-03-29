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
	$reponse= $bdd->query('SELECT adresse,nom,prenom FROM mail,identification where identification.id=mail.id_etudiant') or die( print_r($bdd->errorInfo()));
	$reponse ->execute();
	$rows=$reponse->fetchAll(PDO::FETCH_ASSOC);
	foreach($rows as $row){
		echo "<h5 class=\"nom\" align=\"center\">";
		echo $row['nom']." ".$row['prenom'];
		echo "</h5>";
		echo "<br>";
		echo "<div class=\"info\" style=\"display:none\" align=\"center\">";
		echo $row['adresse'];
		echo "</div>";
		echo "<br>";
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
<script>
		var listTitle = document.getElementsByClassName("nom");
		var listInfo = document.getElementsByClassName("info");
		var listBool = new Array();
		for(i=0;i<listTitle.length;i++){
			listBool.push(false);
		}

		for(i=0;i<listTitle.length;i++){
			listTitle[i].onclick = function(paramTitle){
				index = indexOfArray(listTitle, paramTitle.target)
				console.log(index);
				if(listBool[index]){
					listBool[index] = false;
					listInfo[index].style.display = "none";
				}else{
					listBool[index] = true;
					listInfo[index].style.display = "block";
				}
			};
		}

		function indexOfArray(arr, ele){
			l=arr.length;
			for(i=0;i < l;i++){
				if(arr[i]==ele)
					return i
			}
			return -1;
		}
		
	</script>
</html>