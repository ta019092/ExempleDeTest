<link rel="stylesheet" href="css/monCSS.css">
<?php
function listeHospitalisationsText(){
	$fichier=fopen("hospitalisations.txt","r");
	if ($fichier==null){
		echo "<br>Fichier introuvable";
		exit;
	}
	//echo "Taille du fichier = ".filesize("hospitalisations.txt");
	$entete=array();
	$ligne=fgets($fichier);
	$entete=explode(";",$ligne);
	$etat=1;
	while(!feof($fichier)){
		if ($etat==2){
			echo "<br><b>".$entete[0]."=</b>".strtok($ligne,";");
			$taille=count($entete);
			for($i=1;$i<$taille;$i++)
				echo "<br><b>".$entete[$i]."=</b>".strtok(";");
			echo "<br>***************************************";
		}
		else{
		   $etat=2;
		}
		$ligne=fgets($fichier);
	}
	fclose($fichier);
}
function listeHospitalisationsHTML(){
	$fichier=fopen("hospitalisations.txt","r");
	if ($fichier==null){
		echo "<br>Fichier introuvable";
		exit;
	}
	//echo "Taille du fichier = ".filesize("hospitalisations.txt");
	$entete=array();
	$ligne=fgets($fichier);
	$entete=explode(";",$ligne);
	echo "<table border=1>";
	echo "<caption>Liste des Hospitalisations</caption>";
	echo "<thead><tr>";
	$taille=count($entete);
	for($i=0;$i<$taille;$i++)
		echo "<th>".$entete[$i]."</th>";
	echo "</tr></thead>";
	$etat=1;
	while(!feof($fichier)){
		if ($etat==2){
		    echo "<tr>";
			$elem=strtok($ligne,";");
			while($elem!==false){
				echo "<td>".$elem."</td>";
				$elem=strtok(";");
			}
			echo "</tr>";
		}
		else{
		   $etat=2;
		}
		$ligne=fgets($fichier);
	}
	echo "</table>";
	fclose($fichier);
}
function listeHospitalisationsEtab($codeE){
	$fichier=fopen("hospitalisations.txt","r");
	if ($fichier==null){
		echo "<br>Fichier introuvable";
		exit;
	}
	//echo "Taille du fichier = ".filesize("hospitalisations.txt");
	$entete=array();
	$ligne=fgets($fichier);
	$entete=explode(";",$ligne);
	echo "<table border=1>";
	echo "<caption>Liste des Hospitalisations</caption>";
	echo "<thead><tr>";
	$taille=count($entete);
	for($i=0;$i<$taille;$i++)
		echo "<th>".$entete[$i]."</th>";
	echo "</tr></thead>";
	$etat=1;
	while(!feof($fichier)){
		if ($etat==2){   
			$elem=strtok($ligne,";");
			if ($elem==$codeE){
			echo "<tr>";
			while($elem!==false){
				echo "<td>".$elem."</td>";
				$elem=strtok(";");
			}
			echo "</tr>";
		}
		}
		else{
		   $etat=2;
		}
		$ligne=fgets($fichier);
	}
	echo "</table>";
	fclose($fichier);
}
//Le controleur
$action=$_POST['monAction'];
switch($action){
	case "obtenirListe" :
		listeHospitalisationsHTML();
	break;
	case "obtenirListeEtab" :
	     $codeE=$_POST['codeE'];
		listeHospitalisationsEtab($codeE);
	break;
}
echo "<br><br><a href=\"accueilHopital.html\">Retour a la page accueil</a>";
?>