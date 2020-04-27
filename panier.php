
<?php
session_start();
//initialisation des varibles 
if(! isset($_POST["envoi"])) $_POST["envoi"]=""; 
if(! isset($_SESSION['prixTotal']))  $_SESSION['prixTotal']=0; 
if(! isset($_SESSION['code'])) $_SESSION['code']=0; 
if(! isset($_SESSION['article'])) $_SESSION['article']=""; 
if(! isset($_SESSION['prix'])) $_SESSION['prix']=0; 
 


//AJOUTER
if($_POST["envoi"]=="AJOUTER" && $_POST["code"]!="" &&  $_POST["article"]!="" && $_POST["prix"]!="")
{
$code=$_POST["code"];  
$article= $_POST["article"];  
$prix= $_POST["prix"]; 	
$_SESSION['code']= $_SESSION['code']."//".$code;  
$_SESSION['article']= $_SESSION['article']."//".$article;  
$_SESSION['prix']= $_SESSION['prix']."//".$prix; 
}
//VERIFIER
if($_POST["envoi"]=="VERIFIER")
{
echo "<table border=\"1\" >";
echo "<tr><td colspan=\"3\"><b>Récapitulatif de votre commande</b></td>";
echo "<tr><th>&nbsp;code&nbsp;</th><th>&nbsp;article&nbsp;</ th><th>&nbsp;
?prix&nbsp;</th>";
$total=0;
$tab_code=explode("//",$_SESSION['code']);  
$tab_article=explode("//",$_SESSION['article']);  
$tab_prix=explode("//",$_SESSION['prix']);  

for($i=1;$i<count($tab_code);$i++)  
{
echo "<tr> <td>{$tab_code[$i]}</td> <td>{$tab_article[$i]}</td><td>
?".sprintf("%01.2f", $tab_prix[$i])."</td>";
$_SESSION['prixTotal']+=$tab_prix[$i];  
}
echo "<tr> <td colspan=2> PRIX TOTAL </td> <td>".sprintf("%01.2f", $_SESSION['prixTotal'])."
?</td>";
echo "</table>";
}
//ENREGISTRER
if($_POST["envoi"]=="ENREGISTRER")
{
$idfile=fopen("commande.txt",w);
//
$tab_code=explode("//",$_SESSION['code']);
$tab_article=explode("//",$_SESSION['article']);
$tab_prix=explode("//",$_SESSION['prix']);
for($i=0;$i<count($tab_code);$i++)  

{
fwrite($idfile, $tab_code[$i]." ; ".$tab_article[$i]." ; ".$tab_prix[$i].";
?\n");
}
fclose($idfile);
}
//LOGOUT
if($_POST["envoi"]=="LOGOUT")
{
session_unset();  
session_destroy();  
echo "<h3>La session est terminée</h3>";
}
$_POST["envoi"]=""; 
?>

 

