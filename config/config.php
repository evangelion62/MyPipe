<?php
// Rapporte les erreurs d'exécution de script mais pas les warning
//error_reporting(E_ALL & ~E_WARNING);

//tableau alerte erreur utilisateur
$userErrors = array();

//connection à la bdd
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=Mypipe','root','');
}
catch (Exception $e)
{
	$_GET['controler']='install';
	$_GET['action']='bddFirstConfig';
	$userErrors['bdderror']='Mauvaise configuration de la base de données. Veuillez vérifier vos informations!';
}
//autoload
function chargerClasse($classe)
{
	// On inclut la classe correspondante au paramètre passé.
	require_once 'model/'.$classe . '.class.php';
}

spl_autoload_register('chargerClasse');

//définition des variable controler et action
if (!empty($_GET['controler'])) {
	$_GET['controler']=stripslashes($_GET['controler']);
	$_GET['controler']=htmlspecialchars($_GET['controler']);
	$controler='controler/'.$_GET['controler'].'.php';
}else{
	$controler='controlers/index.php';
}

if (!empty($_GET['action'])){
	$_GET['action']=stripslashes($_GET['action']);
	$_GET['action']=htmlspecialchars($_GET['action']);
	$action=$_GET['action'];
}else{
	$action='index';
}

//demarage du module de session
session_start();
