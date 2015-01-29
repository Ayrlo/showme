<?php
function bdd(){
	$serveur = "localhost";
	$base = "php";
	$user = "root";
	$pass = "";

	$lien = mysqli_connect($serveur, $user, $pass, $base);

	if ($lien->connect_error) {
    	die('Erreur de connexion ('.$lien->connect_errno.')'. $lien->connect_error);
	}
	return $lien;
}

function signup($nom,$prenom,$adress,$mail,$pass,$sexe,$phrase,$reponse){
	$passMd5=md5($pass);
	$reponseMd5=md5($reponse);
	$req="INSERT INTO personne VALUES (Null,'$nom','$prenom','$adress','$mail','$passMd5','$sexe','$phrase','$reponseMd5',0)";
	$res=mysqli_query(bdd(),$req);
}

function connect($mail,$pass){
	$p=md5($pass);
	$req="SELECT * FROM personne WHERE mail='$mail' AND pass='$p' ";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function coPersonne($key){
	$req="UPDATE personne SET etat=1 WHERE cle_personne='$key' ";
	$res=mysqli_query(bdd(),$req);
}
function decoPersonne($key){
	$req="UPDATE personne SET etat=0 WHERE cle_personne='$key' ";
	$res=mysqli_query(bdd(),$req);
}
function personneCo(){
	$req="SELECT Count(cle_personne)  as nbr FROM personne WHERE etat=1 ";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getUserMail($mail){
	$req="SELECT *  FROM personne WHERE mail='$mail'";
	$res=mysqli_query(bdd(),$req);
	$laLigne=mysqli_fetch_all($res);
	return $laLigne ;
}
function getMembre(){
	$req="SELECT (cle_personne) as nbr  FROM personne";
	$res=mysqli_query(bdd(),$req);
	$laLigne=mysqli_fetch_all($res);
	return $laLigne ;
}
function getKeyUser($mail){
	$req="SELECT cle_personne FROM personne WHERE mail='$mail'";
	$res=mysqli_query(bdd(),$req);
	$laLigne=mysqli_fetch_all($res);
	return $laLigne ;
}
function getLastUser(){
	$req="SELECT MAX(cle_personne)as id FROM personne";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getTofProfil($key){
	$req="SELECT img FROM personne WHERE cle_personne=$key";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function delTofProfil($key){
	$req="UPDATE personne SET img='' WHERE cle_personne=$key";
	$res=mysqli_query(bdd(),$req);
}
function setTofProfil($key,$img){
	$req="UPDATE personne SET img='$img' WHERE cle_personne=$key";
	$res=mysqli_query(bdd(),$req);
}
function getFriends($key){
	$req="SELECT DISTINCT cle_personne_recep FROM amis WHERE cle_personne=$key AND etat=2";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes ;
}
function getUser($key){
	$req="SELECT * FROM personne WHERE cle_personne=$key";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes ;
}
function searchFriend($name,$fname){
	$req="SELECT * FROM personne WHERE nom LIKE '%$name%' AND prenom LIKE '%$fname%'";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes ;
}
function searchFriendOnlyFname($fname){
	$req="SELECT * FROM personne WHERE prenom LIKE '%$fname%'";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes ;
}

function addFriend($key,$keyAmis){
	$req="INSERT INTO amis VALUES(Null,$key,$keyAmis,1)";
	$res=mysqli_query(bdd(),$req);
}
function getWaitFriend($key){
	$req="SELECT cle_personne_recep
	FROM amis
	WHERE cle_personne=$key 
	AND etat=1 ";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes ;
}
function getAskFriend($key){
	$req="SELECT cle_personne FROM amis WHERE cle_personne_recep=$key AND etat=1";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes ;
}
function acceptFriend($key,$moi){
	$req="UPDATE amis  SET etat=2 WHERE cle_personne_recep=$moi AND cle_personne=$key AND etat=1";
	$res=mysqli_query(bdd(),$req);
}
function rejectFriend($key,$moi){
	$req="UPDATE amis  SET etat=3 WHERE cle_personne_recep=$moi AND cle_personne=$key AND etat=1";
	$res=mysqli_query(bdd(),$req);
}
function checkIfIsMyFriend($key,$keyAmis){
	$req="SELECT cle_amis,etat FROM amis WHERE cle_personne=$key AND cle_personne_recep=$keyAmis AND etat IN(2,1)";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes ;;
}
function addMsg($key,$key1,$msg,$date){
	$req="INSERT INTO message VALUES (Null,$key,$key1,'$msg','$date',0)";
	$res=mysqli_query(bdd(),$req);
}
/**
*@return Recupere tous les msg entre deux utilisateur et renvoie le tous sous forme de tableaux associatif trié en ordre croissant de date
*/
function getMsg($key,$key1){
	$req="SELECT *  FROM message WHERE cle_personne IN($key,$key1) AND cle_personne_recep IN($key1,$key) ORDER BY cle_msg DESC";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}

function getMsgNoRead($key){
	$req="SELECT * FROM message WHERE cle_personne_recep=$key AND etat=0";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getLastMsg($key,$key1){
	$req="SELECT last FROM message WHERE cle_personne =$key AND cle_personne_recep=$key1 ";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function setLastMsg($key,$key1,$last){
	$req="UPDATE message SET last=$last WHERE cle_personne=$key AND cle_personne_recep=$key1" ;
	$res=mysqli_query(bdd(),$req);
}
function SetMsgToRead($key,$keySender){
	$req="UPDATE message  SET etat=1 WHERE cle_personne_recep=$key AND cle_personne=$keySender AND etat=0";
	$res=mysqli_query(bdd(),$req);
}
function initLike($ev,$key){
	$req="INSERT INTO aime VALUES(null,$ev,$key,1)";
	$res=mysqli_query(bdd(),$req);
}

function getLike($key){
	$req="SELECT count(`like`) as nbr FROM aime WHERE  cle_evenement=$key";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getLastIdEv(){
	$req="SELECT max(cle_evenement) FROM  evenement";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function addEv($key,$date,$text,$doc,$etat){
	$req="INSERT INTO evenement VALUES (Null,$key,'$date','$text',$doc,0,$etat)";
	$res=mysqli_query(bdd(),$req);
}
function getEv(){
	$req="SELECT * from  evenement ORDER BY evenement.date DESC";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getMyEv($key){
	$req="SELECT * FROM evenement WHERE cle_personne=$key ORDER BY cle_evenement DESC";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getAllEvPublic(){
	$req="SELECT * FROM evenement WHERE etat=0 ORDER BY cle_evenement DESC";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function delEv($key){
	$req="DELETE FROM evenement WHERE  cle_evenement=$key";
	$res=mysqli_query(bdd(),$req);
}
/**
*
*/
function getDoc($ev){
	$req="SELECT * FROM file WHERE cle_evenement=$ev";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function addDoc($ev,$type,$url){
	$req="INSERT INTO file VALUES (null,$ev,'$type','$url')";
	$res=mysqli_query(bdd(),$req);
}


function getLastIdDoc(){
	$req="SELECT MAX(cle_doc)as id FROM file";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}

function getSexe(){
	$req="SELECT * FROM sex";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getQuestion(){
	$req="SELECT * FROM question";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getMyQuestion($key){
	$req="SELECT question.id,question.libelle FROM personne,question WHERE personne.phrase=question.id AND personne.cle_personne=$key";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function answaQuestion($ask,$answa){
	$req="SELECT pass FROM personne WHERE phrase='$ask' and reponse='$answa'";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function temp($ask,$answa,$b){
	$req="UPDATE personne SET pass ='$b' WHERE phrase=$ask and reponse='$answa'";
	$res=mysqli_query(bdd(),$req);
}

function verifAime($id,$key){
	$req="SELECT `like`  FROM aime WHERE cle_evenement=$id AND cle_personne=$key" ;
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}

function unLike($id,$key){
	$req="DELETE FROM  aime  WHERE cle_evenement=$id AND cle_personne=$key" ;
	$res=mysqli_query(bdd(),$req);
}
function addComs($ev,$key,$sujet){
	$req="INSERT INTO commentaire VALUES (null,$ev,$key,'$sujet')";
	$res=mysqli_query(bdd(),$req);
}
function verifIsMyCom($com,$key){
	$req="SELECT cle_com FROM commentaire WHERE  cle_com=$com AND cle_personne=$key ";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function getComs($ev){
	$req="SELECT * FROM commentaire WHERE cle_ev=$ev";
	$res=mysqli_query(bdd(),$req);
	$lesLignes=mysqli_fetch_all($res);
	return $lesLignes;
}
function alterComs($ev,$key,$sujet,$newSujet){
	$req="UPDATE commentaire SET libelle ='$newSujet' WHERE cle_personne=$key AND cle_ev=$ev AND libelle='$sujet'";
	$res=mysqli_query(bdd(),$req);
}
function delComs($key){
	$req="DELETE FROM  commentaire  WHERE cle_com=$key" ;
	$res=mysqli_query(bdd(),$req);
}
/////////////////////////////////////////////////////// FONCTION NON BASE DE DONNÉES/////////////////////////////////////

//Deconecter l'utilisateur 
function deconnect(){
	session_destroy();
}
//Initialise les variable de session Nom et Prenom
function isconect($cle,$nom,$prenom,$mail){
	$_SESSION["cle"]=$cle;
	$_SESSION["nom"]=$nom;
	$_SESSION["prenom"]=$prenom;
	$_SESSION["mail"]=$mail;
	return $_SESSION;
}
//Retourne vrai si l'utilisateur est connecte
function estConnecte(){
  return isset($_SESSION['nom']);
}


?>