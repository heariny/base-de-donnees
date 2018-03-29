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


<div id="wrapper">
<h3>Connection refusee</h3>
<?php

echo "<p>L'information d'identification n'est pas correcte</p> ";
echo "<p><a href=\"connection.php\">Retourner au page de connection</p>";



?>
</div>
</body>
</html>