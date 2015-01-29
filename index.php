<?php 
session_start();
/**
if (isset($_POST["save"])) {
    setcookie('stay', 'stay', time() + 365*24*3600, null, null, false, true);
}
var_dump($_COOKIE);
if (!isset($_COOKIE["stayOff"])){
    $_REQUEST["uc"]=="Deconnexion";
}

setcookie('stayOff', 'stayOff', time() + 1000, null, null, false, true);
*/
?>
<head><title>Showme</title><link rel="icon" href="source/icon.ico" /><?php
/** 
////////////////////////////////////////////////////////////////////////////Insertion de Jquery selon le statut r&#233;seaux///////////////////////////////////////////
*/
			if (!$sock = @fsockopen('www.google.fr', 80, $num, $error, 5)){?>
				<script type="text/javascript" src="source/jquery-1.11.1.min.js"></script>
                <?php 
			} 
			else{?>
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
                <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
                <?php
			}?>
          <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
          <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>

</head>
<?php
/** 
////////////////////////////////////////////////////////////////////////////Variables et ajouts ,Constants///////////////////////////////////////////
*/
require("model.php");
$date=date("Y/m/d H:i:s");
/**
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::  CSS   :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/
?>
<script>
$(function(){
    /*
$('img').bind('click',function(e){
var mx = e.pageX;
var my = e.pageY;
var x = mx - 150;
var y = my - 100;
var w = 300;
var h = 200;
$('#popup').remove();
$('html').append('<div id="popup"><p>Ceci est une popup. Le fond du site est visible au travers et celui-ci est floutté.<br/><a href="">Fermez la popup</a></p><div id="fond"></div></div>');
$('#popup').css({top:y,left:x});
//$('#fond').css({backgroundPosition:'-'+x+'px -'+y+'px'});
$('#popup').draggable({
drag:function(e){
var nx = $(this).css('left');
var ny = $(this).css('top');
//$('#fond').css({backgroundPosition:'-'+nx+' -'+ny});
e.stopPropagation();
}
});
$('#popup a').click(function(e){
$('#popup').remove();
return false;
});
}); 
*/ 

    
   $('.publication,.contenu,#friends,#waitFriend,#askFriend,#listMessage,#message1,#statut,#annexe,#message,.publicationEV,.contenuEv,.moi,.reponse').hover(function() {
        sOK=0;
        $(this).css("box-shadow","0px 0px 14px black");
        $(this).click(function(){
            sOK=1;
        });
    },function(){
        if(sOK==0){
            $(this).css("box-shadow","0px 0px 0px");
        }
    });

    $('a,img,p').hover(function() {
        $(this).css("opacity","0.5")
    },function(){
            $(this).css("opacity","1");
    });
    $( "#statut" ).hide();
    $( "#annexe" ).hide();
    $( "#corps" ).css("top","25px");
    $( "#corps" ).css("height","470²px");

    // run the currently selected effect
    function runEffect() {
        $( "#statut" ).show(1000);
        $( "#annexe" ).show(1000);
    };
// set effect from select menu value
    var curs=0;
    $( "#talk" ).click(function() {
        if (curs==0) {
            $( "#corps" ).css("height","375px");
            $( "#corps" ).animate({top:"145px" },1000);
            runEffect();
            $( "textarea[name=text]" ).focus();
            curs=1;
        }else{
            $( "#corps" ).animate({top:"25px"},1000);
            $( "#corps" ).css("height","470px");
            $( "#statut" ).hide("slow");
            $( "#annexe" ).hide("slow");
            curs=0;
        }
    });
    $( "form#a" ).submit(function() {
        $( "#statut" ).hide();
        $( "#annexe" ).hide();
        $( "#corps" ).css("top","25px");
        $( "#corps" ).css("height","470px");
    });
});
</script>
<?php
    if (estConnecte()) {?>
        <script >
            $(function(){
                var like=0;
                var user=$('input[name=idUser]').val();
                $('#like').click(function() {
                    if (like==0 && user!=<?php echo $_SESSION['cle'];?>) {
                        u = parseInt($("#nbrLike").html());
                        $("#nbrLike").html(u+1);
                        like=1;
                    }else{
                        if ($("#nbrLike").html()!=0) {  
                            u = parseInt($("#nbrLike").html());
                            $("#nbrLike").html(u-1);
                            like=0;
                        };
                    }
                });
                var see=0;
                 $(".photoProfil").hover(function(){
                    if (see==0) {
                        alert("Je peux ajouter un avatar");
                        see=1;
                    }
                 },function(){
                    if(see==0){
                        alert("Je peux ajouter un avatar");
                        see==1;
                    }
                });
                $("input[name=imgToUpload]").click(function(){
                    setTimeout(function() {
                        var formData = new FormData($('form#b')[0]);
                        $.ajax({
                            url: "index.php?uc=setImgProfil",
                            type: 'POST',
                            data: formData,
                            async: false,
                            success: function (data) {
                                if($("input[type=file]").val()!=""){
                                    $( "#tofProfil" ).html("");
                                    $( "#tofProfil" ).html( data );
                                }
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                        return false;
                    }, 5000);
                });
                 $(".photoProfilOn").dblclick(function(){
                    var pers = <?php echo  $_SESSION["cle"]?>;
                    delTofProfil(pers);
                    $(this).remove();
                    $("#tofProfil").html('<form id="b"><div style="height:0px;overflow:hidden"><input type="file" name="imgToUpload" id="imgToUpload"></input></div><img src="source/user.png" class="photoProfil" onclick="chooseTofProfl();"><input type="hidden" name="id" value="<?php echo $_SESSION["cle"]?>"></form>')
                });
            });
        </script><?php
    }?>
<style type="text/css">
html{
	background: url("source/pattern.gif") repeat;
	font-family: 'Indie Flower', cursive;
	font-size: 15px;
	color: rgb(203,232,107);
}
a{
	color: rgb(254,67,101);
}
ul:hover a:hover img{
   -webkit-filter: grayscale(1) blur(5px);
}
#search{
    left: 900px;
    position: absolute;
    top: 10px; 
}
#titre{
    left: 0;
    position: absolute;
    top: 450px;
    transform: rotate(270deg);
    width: 90px;
}
#soundcloud{
    height: 110px;
    left: 35px;
    position: absolute;
    top: 245px;
    width: 305px;
}
#infos {
    left: 1085px;
    position: absolute;
    top: 75px;
    width: 230px;
}
#message{
    height: 345px;
    left: 955px;
    overflow: auto;
    position: absolute;
    top: 160px;
    width: 280px;
}
#listMessage{
    border: 1px solid rgb(254, 67, 101);
    height: 325px;
    left: 23px;
    overflow: auto;
    padding: 10px;
    position: absolute;
    top: 35px;
    width: 100px;
}
#message1{
    border: 1px solid rgb(203, 232, 107);
    height: 345px;
    overflow: auto;
    position: absolute;
    right: 23px;
    top: 35px;
    width: 450px;
}
#txt{
    height: 25px;
    left: 955px;
    position: absolute;
    top: 515px;
    width: 280px;
}
#reponse{
	background: url("source/footer_lodyas.png") repeat; 
	font-weight: bold;
	color: white;
	font-family: MV Boli;
	font-size: 10px;
	border: 1px solid rgb(254,67,101);
	border-radius: 10px;
	padding: 10px;
	word-wrap: break-word;
	max-width: 145px;
	position: sticky;
	margin-left: 25px;

}
.moi{
	background: url("source/footer_lodyas.png") repeat; 
	font-weight: bold;
	color: white;
	font-family: MV Boli;
	font-size: 10px;
	border: 1px solid rgb(203, 232, 107);
	border-radius: 10px;
	padding: 10px;
	max-width: 145px;
	word-wrap: break-word;
	position: sticky;
}
.moi1{
	background: url("source/footer_lodyas.png") repeat; 
	font-weight: bold;
	color: white;
	font-family: MV Boli;
	font-size: 13px;
	border: 1px solid rgb(203, 232, 107);
	border-radius: 10px;
	padding: 10px;
	word-wrap: break-word;
	width: 255px;
	position: sticky;
    right: 3px;
}
#reponse1{
   background: url("source/footer_lodyas.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid rgb(254, 67, 101);
    border-radius: 10px;
    color: white;
    font-family: MV Boli;
    font-size: 13px;
    font-weight: bold;
    left: 59px;
    padding: 10px;
    position: sticky;
    width: 255px;
    word-wrap: break-word
}
/********************/
#user{
    border-radius: 20px;
    height: 140px;
    left: 955px;
    padding-left: 10px;
    position: absolute;
    top: 15px;
    width:380px;
}
#user input[type="submit"] {
	 width: 125px;
}
#signup{
    border-radius: 20px;
    height: 55px;
    left: -1px;
    padding-left: 10px;
    position: absolute;
    top: 80px;
    width: 270px;
}
#signup input[type="submit"] {
	 width: 150px;
}
.prenom{
	background: url("source/p.png") no-repeat;
}
.nom{
	background: url("source/ndf.png") no-repeat;
}
.dressPost{
	background: url("source/dressPost.png") no-repeat;
}
.dress{
	background: url("source/dress.png") no-repeat;
}
.cdress{
	background: url("source/cdress.png") no-repeat;
}
.mdp{
	background: url("source/mdp.png") no-repeat;
}
#utilConect{
	background: url("source/tweed.png") repeat;
    height: 25px;
    left: 30px;
    position: absolute;
    top: 160px;
    width: 925px;

}
#menuGauche{
    height: 300px;
    overflow: auto;
    position: absolute;
    left: 200px;
    top: 40px;
    width: 100px;
}
#menuPrincipal {
    height: 500px;
    left: 305px;
    padding-left: 10px;
    position: absolute;
    top: 40px;
    width: 633px;
}
#corps {
    left: 30px;
    overflow: auto;
    padding-left: 10px;
    position: absolute;
    width: 565px;
}
.contenu{
	border: 1px solid rgb(254, 67, 101);
    color: white;
    padding: 20px;
    position: sticky;
    left: 0px;
    width:300px;
    word-wrap: break-word;
}
#statut{
    border: 1px solid;
    height: 110px;
    left: 30px;
    padding-left: 5px;
    position: absolute;
    top: 25px;
    width: 325px;
}
#statut textarea{
    height: 80px;
    resize: none;
    width: 255px;
}
.publier{
    float: right;
    height: 30px;
    position: absolute;
    right: 10px;
    top: 85px;
    width: 135px;
}
.photo{
    float: right;
    position: absolute;
    right: 5px;
    top: 5px;
}
.publication{
    margin-bottom: 10px;
    min-height: 100px;
    padding: 10px;
    position: static;
    top: 5px;
    width: 525px;
    word-wrap: break-word

}
#otherFriend{
    height: 450px;
    padding: 10px;
    position: absolute;
    right: 30px;
    top: 10px;
    width: 255px;
}
#waitFriend{
    height: 185px;
    overflow: auto;
    padding: 10px;
    position: sticky;
    right: 30px;
    width: 225px;
}
#askFriend{
    height: 210px;
    left: 10px;
    overflow: auto;
    padding: 10px;
    position: absolute;
    top: 225px;
    width: 225px;
}
#friends{
    height: 370px;
    left: 30px;
    overflow: auto;
    padding: 10px;
    position: absolute;
    top: 75px;
    width: 280px;
}
#annexe{
    border: 1px solid rgb(254, 67, 101);
    height: 110px;
    position: absolute;
    right: 30px;
    top: 25px;
    width: 245px
}
#menuPrincipal1{
    height: 525px;
    left: 125px;
    position: absolute;
    top: 25px;
    width:820px;
}
#ev1{
    height: 310px;
    left: 5px;
    overflow: auto;
    position: absolute;
    top: 2px;
    width: 400px;
    word-wrap: break-word;
}
#ev2{
    height: 310px;
    overflow: auto;
    position: absolute;
    right: 15px;
    top: 2px;
    width: 400px;
    word-wrap: break-word;
}
.publicationEV{
    margin-left: 10px;
    margin-top: 20px;
    min-height: 100px;
    padding: 5px;
    position: static;
    top: 5px;
    width: 355px;
    word-wrap: break-word;
}
#like{
 	color: white;
    margin-top: 2px;
    right:0px;
    padding: 6px;
    position: sticky;
    width: 75px;
    word-wrap: break-word;
}
.contenuEv{
    border: 1px solid rgb(254, 67, 101);
    color: white;
    left: 0;
    padding: 20px;
    position: sticky;
    width: 310px;
    word-wrap: break-word;
}
#text1{
    background: url("source/grey_wash_wall.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
    height: 33px;
    left: 165px;
    padding-left: 5px;
    position: absolute;
    top: 385px;
    width: 455px;
}

#del{
	left: 2px;
    margin: 10px;
    position: sticky;
    width: 15px;
}
#delUploadFile{
    left: 40px;
    opacity: 0.9;
    position: absolute;
    top: 95px;
    width: 15px;
}
#uploadFile{
	 height:110px; 
	 width:130px;
}
#talk{
    -ms-transform: rotate(25deg); /* IE 9 */
    -webkit-transform: rotate(25deg); /* Chrome, Safari, Opera */
    transform: rotate(25deg);
    position: absolute;
    right: 0;
    top: 0;
    width: 70px;
}
#tofProfil{
    height: 75px;
    left: 100px;
    position: absolute;
    width: 90px;
}
.comments{
    height: 75px;
    left: 365px;
    margin-top: 35px;
    position: absolute;
    width: 190px;
    word-wrap: break-word;
    overflow: auto;    
}
</style>
<?php
/**
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::   AJAX ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/
?>
<script>
function getXhr(){
                                var xhr = null; 
				if(window.XMLHttpRequest) 
				   xhr = new XMLHttpRequest(); 
				else if(window.ActiveXObject){ 
				   try {
			                xhr = new ActiveXObject("Msxml2.XMLHTTP");
			            } catch (e) {
			                xhr = new ActiveXObject("Microsoft.XMLHTTP");
			            }
				}
				else { 
				   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
				   xhr = false; 
				} 
                                return xhr;
}

function sendMsg(id,msg) {
				var xhr = getXhr();
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						document.getElementById('message').innerHTML = leselect;
					}
				}
				xhr.open("POST","index.php?uc=Majax&idAmis="+id,true);
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xhr.send("message="+id+'#..#'+msg);
}

function connect() {
				var xhr = getXhr();
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						document.getElementById('menuPrincipal').innerHTML = leselect;
					}
				}
				m=document.getElementById("email").value;
				p=document.getElementById("pword").value;
				xhr.open("POST","index.php",true);
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xhr.send("valider="+m+'/'+p);
}
function addFriend(){
				var xhr = getXhr();
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						document.getElementById('infos').innerHTML = leselect;
					}
				}
				m=document.getElementById("mailFriend").value;
				xhr.open("POST","index.php",true);
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xhr.send("friendAdd="+m);

}
function aime(e){
				var xhr = getXhr();
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						document.getElementById("annexe").innerHTML = leselect;
					}
				}
				xhr.open("POST","index.php?uc=aime",true);
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xhr.send("aime="+e);

}
function delEv(e){
				var xhr = getXhr();
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						document.getElementById("annexe").innerHTML = leselect;
					}
				}
				xhr.open("POST","index.php?uc=aime",true);
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xhr.send("del="+e);
}
function setToRead(){
				var xhr = getXhr();
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						document.getElementById("infos").innerHTML = leselect;
					}
				}
				del = document.getElementById('cle_geteur').value;
				xhr.open("POST","index.php?uc=read",true);
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xhr.send("id="+del);
}
function setToReadA(){
				var xhr = getXhr();
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						leselect = xhr.responseText;
						document.getElementById("infos").innerHTML = leselect;
					}
				}
				del = document.getElementById('cleGeteur').value;
				xhr.open("POST","index.php?uc=read",true);
				xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				xhr.send("id="+del);
}
function setTofProfil(e){
                var xhr = getXhr();
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        document.getElementById("infos").innerHTML = leselect;
                    }
                }
                xhr.open("POST","index.php?uc=setImgProfil",true);
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                xhr.send("id="+e);
}
function delTofProfil(pers){
                var xhr = getXhr();
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        document.getElementById("infos").innerHTML = leselect;
                    }
                }
                xhr.open("POST","index.php?uc=delImgProfil",true);
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                xhr.send("id="+pers);
}
function addComs(id,commentaire){
                var xhr = getXhr();
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        document.getElementById("infos").innerHTML = leselect;
                    }
                }
                xhr.open("POST","index.php?uc=addComent",true);
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                xhr.send("id="+id+'#..#'+commentaire);
}
function delComs(idCom){
                var xhr = getXhr();
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        document.getElementById("infos").innerHTML = leselect;
                    }
                }
                xhr.open("POST","index.php?uc=delComs",true);
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                xhr.send("com="+idCom);
}
function alterComs(id,newText){
                var xhr = getXhr();
                xhr.onreadystatechange = function(){
                    if(xhr.readyState == 4 && xhr.status == 200){
                        leselect = xhr.responseText;
                        document.getElementById("infos").innerHTML = leselect;
                    }
                }
                xhr.open("POST","index.php?uc=alterComs",true);
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                xhr.send("com="+id+'#..#'+newText);
}
 
function chooseFile() {
    document.getElementById("fileToUpload").click();
}
function chooseTofProfl() {
    document.getElementById("imgToUpload").click();
}
</script>
<body>
<?php
/**
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: SECURE LINK
*/
?>
<?php 
if (isset($_REQUEST["uc"])) {
		if ($_REQUEST["uc"]=="accueil" || $_REQUEST["uc"]=="friends" || $_REQUEST["uc"]=="read" || $_REQUEST["uc"]=="Deconnexion" || $_REQUEST["uc"]=="alterComs"||  $_REQUEST["uc"]=="delComs"|| $_REQUEST["uc"]=="addComent"|| $_REQUEST["uc"]=="delImgProfil" || $_REQUEST["uc"]=="setImgProfil" || $_REQUEST["uc"]=="seeUploadFile" || $_REQUEST["uc"]=="aime" || $_REQUEST["uc"]=="forget" || $_REQUEST["uc"]=="msg" || $_REQUEST["uc"]=="nextPrevious" || $_REQUEST["uc"]=="profil" || $_REQUEST["uc"]=="ev" || $_REQUEST["uc"]=="Majax" || $_REQUEST["uc"]=="signup" || $_REQUEST["uc"]=="Pajax") {
			$uc=$_REQUEST["uc"];
		}else{
			$uc="accueil";
		}
}else{

	$uc='accueil';
}
/**
										FIN SECURE LINK
*/

/**
																						SWITCH $UC												
*/
 if (isset($_SESSION["cle"])) {
    $cle=$_SESSION["cle"];
    $scan=scandir("conversation/");
    foreach ($scan as $key) {
       $match=preg_match('/^['.$cle.']/', $key);
       if ($match==1) {
            $cut=substr($key,0,2);
            if ($cut!=$cle) {
                $last=getLastMsg($cle,$cut);
                if (!empty($last)) {   
                    if (isset($_SESSION["cle"])) {
                        $_SESSION["count_$cut"]=$last[0][0];
                    }
                }
            }
       }
    }
}

if (isset($_GET["idAmis"])) {
    $id=$_GET["idAmis"];
    if (isset($_SESSION["count_$id"])) {
        $last=getLastMsg($cle,$id);
        if (!empty($last)) {
            if ($last[0][0]>$_SESSION["count_$id"]) {?>
                <script type="text/javascript">alert()</script><?php
            }
        }
        
    }
}                                                                                  

	switch ($uc) {
		/**
																		CAS ACCEUIL
*/
		case 'accueil':{
			/**
																SI OUI CONECTER UTILISATEUR   :DIV USER
*/
			if(estConnecte()){?>
				<div id="user">
                    <div id="tofProfil"><?php 
                        $getTof=getTofProfil($_SESSION["cle"]);
                        if ($getTof[0][0]!="") {
                            $getTof=$getTof[0][0];?>
                            <img src="<?php echo $getTof?>" class="photoProfilOn" height="75px" width="90px"><?php
                        }else{?>
                            <form id="b">
                                <div style="height:0px;overflow:hidden">
                                    <input type="file" name="imgToUpload" id="imgToUpload"></input>
                                </div>
                                <img src="source/user.png" class="photoProfil" onclick="chooseTofProfl();">
                                <input type="hidden" name="id" value="<?php echo $_SESSION['cle']?>">
                            </form><?php
                        }?>
                    </div>
                    <?php	
					echo $_SESSION["prenom"].' '.$_SESSION["nom"]."</br></br>";
					$friends=sizeof(getFriends($_SESSION["cle"]));
					echo $friends." amis</br>";
					$msgNoRead=sizeof(getMsgNoRead($_SESSION["cle"]));
					if ($msgNoRead=='0') {	
						echo $msgNoRead." message(s) non lu(s)";
					}else{
						echo "<b><font color='red'>".$msgNoRead."</font></b> message(s) non lu(s)";
					}?>
					<form action="index.php?uc=Deconnexion" method="POST"><input type="submit" name="deco" value="Deconnexion"></form>
				</div>
				<script>
					$(function(){
                        //$('div').draggable();
						$("input[id=fileToUpload]").click(function() {
                            $('#annexe').html('<center><img src="source/ajax-loader.gif"></center>');
                            setTimeout(function() {
								var formData = new FormData($('form#a')[0]);
                                $.ajax({
                                    url: "index.php?uc=seeUploadFile",
        							type: 'POST',
        							data: formData,
        						    async: false,
        							success: function (data) {
                                        $( "#annexe" ).html( data );
                                    },
        							cache: false,
        							contentType: false,
        							processData: false
    							});
  		 	 					return false;
  		 	 			    }, 5000);
						})

                        
						$("form#a").submit(function(){
    						var formData = new FormData($(this)[0]);
    						$.ajax({
        						url: "index.php?uc=ev",
        						type: 'POST',
        						data: formData,
        						async: false,
        						success: function (data) {
        							if($('textarea[name=text]').val()!=""){
										$( "#corps" ).html( data );
                                        $('#annexe').html("");
                                        $('input[type=file]').val("");    
									}else{
										alert("Il semble que cette publication est vide");
									}
        						},
        						cache: false,
        						contentType: false,
        						processData: false
    						});
  		 	 				return false;
						});
								//chekbox
						$('input[name=prive]').click(function() {
							$(this).attr("checked","");
							$('input[name=amis]' ).removeAttr("checked");
							$('input[name=public]' ).removeAttr("checked");
						});
						$('input[name=amis]').click(function() {
							$(this).attr("checked","");
							$('input[name=prive]' ).removeAttr("checked");
							$('input[name=public]' ).removeAttr("checked");
						});
						$('input[name=public]').click(function() {
							$(this).attr("checked","");
							$('input[name=amis]' ).removeAttr("checked");
							$('input[name=prive]' ).removeAttr("checked");
						});
						//menu gauche
						$('a[name=ajouterAmis]').click(function() {
							$('#menuPrincipal').html('<center><form action="index.php?uc=friends" method="POST"><b>RECHERCHER UN AMIS</b><br><input type="text" class="prenom" name="fNameFriend" id="fNameFriend" required="required"><br><input type="text" id="nameFriend" name="nameFriend" class="nom"><br><input type="submit" value="recherche"  name="search"></br></form></center>');
						});
						$('a[name=filActualite]').click(function() {
                            $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
							$('body').load('index.php');
						});
						$('a[name=profil]').click(function() {
                            $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
							$('body').load('index.php?uc=profil&id=<?php echo $_SESSION["cle"];?>');
						});
						$('a[name=mesAmis]').click(function() {
                            $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
							$('body').load('index.php?uc=friends');
						});
						$('a[name=message]').click(function() {
                            $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
							$('body').load('index.php?uc=msg');
						});
                        $('a[name=profilFriend]').click(function() {
                                var i= $(this).attr('id');
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
                                $('body').load('index.php?uc=profil&id='+i);
                        });
                        $('.publication').dblclick(function(){
                            var ev = $(this).find('input[name=cle_ev]').val();
                            var pers = $(this).find('input[name=idUser]').val();
                            if(pers==<?php echo $_SESSION["cle"]?>){
                                if(confirm('Votre publication va être supprimé')){
                                    delEv(ev);
                                    $(this).remove();  
                                }      
                           }else {
                                alert("Vous n'êtes pas l'éditeur de cette publication");
                           }
                        });
                        var like=0;
                        var user=$('input[name=idUser]').val();
                        $('.like').click(function() {
                            if (like==0 && user!=<?php echo $_SESSION['cle'];?>) {
                                u = parseInt($(this).find("#nbrLike").html());
                                $(this).find("#nbrLike").html(u+1);
                                $(this).find("td").css("color","rgb(254, 67, 101)");
                                like=1;
                            }else{
                                if ($(this).find("#nbrLike").html()!=0) {  
                                    u = parseInt($(this).find("#nbrLike").html());
                                    $(this).find("#nbrLike").html(u-1);
                                     $(this).find("td").css("color","rgb(203, 232, 107)"); 
                                    like=0;
                                };
                            }
                        });
                        $(".photoProfilOn").dblclick(function(){
                            var pers = <?php echo  $_SESSION["cle"]?>;
                            delTofProfil(pers);
                            $(this).remove();
                            $("#tofProfil").html('<form id="b"><div style="height:0px;overflow:hidden"><input type="file" name="imgToUpload" id="imgToUpload"></input></div><img src="source/user.png" class="photoProfil" onclick="chooseTofProfl();"><input type="hidden" name="id" value="<?php echo $_SESSION["cle"]?>"></form>')
                        });
                        var showComs=0;
                        var modifCom=0;
                        $('.publication').hover(function(){
                            var taille=$(this).height()-20;
                            $('.comments').hover(function() {
                                $(this).css('height',taille);
                                $(this).css("box-shadow","0px 0px 10px black");
                                $(this).dblclick(function(){
                                    var tailleDivComments = $("#menuPrincipal").height();
                                    $(this).css("height",tailleDivComments);
                                    if (showComs==0) {
                                        var ev= $(this).attr("media");
                                        $(this).prepend('<div id="comentDiv"><textarea name="comentText" id="comentText" media="'+ev+'"  onmousemove="return false"></textarea></div>');
                                        $('#comentText').focus();
                                    }
                                    showComs=1;
                                });
                                $('.comments').keypress(function(event){
                                    if(event.keyCode == 13){
                                        var commentaire=$(this).find("#comentText").val();
                                        var id=$(this).attr("media");
                                        addComs(id,commentaire);
                                        $('#comentText').remove();
                                        if (commentaire!="undefined" && commentaire!="" &&  showComs==1 ) {
                                            $(this).find("ul").append('<li media="'+id+'"><img src="<?php echo $_SESSION["tof"]?>" height="30px" width="30px"><a> '+commentaire+'</a></li>');
                                            showComs=0;                                        
                                        };
                                    }
                                });
                                var fait=0;
                                $('.comments li').dblclick(function(){
                                    if($('a[name=profilFriend]').attr("id")==<?php echo $_SESSION['cle']?>){
                                        var idCom=$(this).attr("media");
                                        if (fait==0) {
                                            if(confirm('Votre commentaire va être supprimé')){
                                                fait=1;
                                            };    
                                        };
                                        if (fait==1) {
                                            delComs(idCom);
                                            $(this).remove();
                                        };
                                    };
                                });
                                /*
                                $('.comments li').click(function(){
                                    $("#comentText").remove();
                                    var id=$(this).attr("id");
                                    var text=$(this).find("a").html();
                                    $(this).replaceWith('<textarea name="comentText" id="'+id+'" onmousemove="return false" >'+text+'</textarea>');
                                    $("textarea[name=comentText]").focus();
                                     modifCom=1;
                                });
                                if (modifCom==1) {
                                    $('.comments').click(function(){
                                        var id=$(this).find('textarea[name=comentText]').attr("media");
                                        var newText=$(this).find("textarea[name=comentText]").html();
                                        alterComs(id,newText);
                                        $(this).find("textarea[name=comentText]").remove();
                                        $(this).find("ul").append('<li id="'+id+'"><a>'+newText+'</a></li>');
                                        modifCom=0;
                                    });
                                }*/
                            },function(){
                                if (showComs==0) {
                                    $(this).css("box-shadow","0px 0px 0px");
                                    $("#comentDiv").remove();
                                };
                                showComs=0;
                            });
                        },function(){
                            showComs=0;
                        });
                        $('.publication').click(function(){
                            if( showComs==0) {
                                $(this).find('.comments').css("box-shadow","0px 0px 0px");
                               $(this).find("#comentDiv").remove();
                                showComs=1;
                           }
                        });
					});
				</script>
					<?php		/**
												AJOUT DIV MENU GAUCHE
*/?>
				<div id="menuGauche">
					<a name="filActualite">Fil d'actualit&#233;</a><br>
					<a name="profil">Mon profil</a><br>
					<a name="mesAmis">Mes amis</a></br>
					<a name="ajouterAmis">Ajouter un amis</a><br>
					<a name="message">Messages</a><br>
				</div>
				<?php		/**
											FIN MENU GAUCHE :DIV MESSAGE
*/?>
				<div id="message"></div><div id="infos"></div>
				<?php		/**
											AJOUT DIV MENU PRINCIPAL
*/?>            
				<div id="menuPrincipal">
					<?php		/**
												AJOUT DIV STATUT /ANNEXE
*/?>
					<div id="annexe"></div>
					FIL D'actualit&#233;
                    <div id ="talk">M'exprimer</div>
					<div id="statut">
						<?php		/**
										JQUERY
*/?>
    					<?php		/**
										FIN JQUERY  /AJOUT FORM PUB 
*/?>
						<form id="a" action="index.php?uc=ev" method="post" enctype="multipart/form-data">
						<textarea name="text" onmousedown="this.onmousemove='return false';"></textarea>
						<div style="height:0px;overflow:hidden">
  							<input type="file" name="fileToUpload" id="fileToUpload"></input>
						</div>
						<img src="source/tof.png" class="photo" onclick="chooseFile();">
						<INPUT type="checkbox" name="prive" value="2"> Priv&#233;
						<INPUT type="checkbox" name="amis" value="1"> Amis seulement
						<INPUT type="checkbox" name="public" value="0" checked> Public
						<input type="hidden" name="id" value="<?php echo $_SESSION['cle']?>">	
    					<button>submit</button>
						</form>
					</div>
					<?php		/**
											FIN AJOUT DIV STATUT
*/?>
					<div id="corps"><?php
						$req=getEv();
						$friend=getFriends($_SESSION["cle"]);
							/**
									POUR TOUT EVENEMENT
*/
						foreach ($req as $anEv) {
						/**
								SI UTILISATEUR AS DES AMIS 
							*/
							if (!empty($friend)) {
                                $f=array_search($anEv[1], $friend[0]);
                               	/**
									SI CE SONT MES EVENEMENT ET CEUX DE MES AMIS
*/
								if ($f==0 || $anEv[1]==$_SESSION["cle"] ) {
									$ev=$anEv[0];
									$id=$anEv[1];
									$time=$anEv[2];
									$libelle=$anEv[3];
									$etat=$anEv[6];
									//personne
									$user=getUser($id);
									$pers=$user[0][2].' '.$user[0][1];
									//
									/**
										SI L ETAT EST PRIVÉÉ
*/
									if ($etat==2) {
									/**
										SI c'est mon EVENEMENT
*/
										if ($id==$_SESSION["cle"]) {
											if(!isset($_SESSION["previousEV"])){?>
                                                <div class="comments" media="<?php echo $ev?>"><?php
                                                    $lesCommentaires=getComs($ev);?>
                                                    <ul><?php
                                                        foreach ($lesCommentaires as $unCom) {
                                                            $tof=getTofProfil($unCom[2]);
                                                            $tof=$tof[0][0];
                                                            echo "<li media='".$unCom[0]."'><img src='$tof' width='30px' height='30px'><a>" .$unCom[3]."</a></li>";
                                                        }?>
                                                    </ul>
                                                </div>
												<div class='publication'>
                                                    <a name='profilFriend' id='<?php echo $id?>'><?php echo $pers?></a><?php echo " a publi&#233 le ".$time."</a><br>";
                                                    $youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenu'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenu'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
													$docs=getDoc($ev);
																			/**
										SI MON EVENEMENT A UN DOCUMENT
*/
													if (!empty($docs)) {
														if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
															<a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
														}
														if (strtolower($docs[0][2])==".do") {?>
															<a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
														}
														if (strtolower($docs[0][2])==".xl") {?>
															<a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
														}
														if (strtolower($docs[0][2])==".pp") {?>
															<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
														}
													}
													$_SESSION["previousEV"]=$ev;								/**
										FIN SI  mon EVENEMENT A UN DOCUMENT
*/?>
													<input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
                                                    <input type="hidden" name="idUser" value="<?php echo $id;?>">
													<div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
														$like=getLike($ev);
														$like=$like[0][0];
														echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
													</div>
													<!--fermeture div publication -->	
												</div><?php
											}else{
												unset($_SESSION["previousEV"]);
											}
										}
										/**
												STOP SI C4EST MON EVENEMENT
										*/
									}else{
											/**
										SI ETAT EVENEMENT PUBLI OU RESERVE AUX AMIS 
										SI LEVENEMENT N'EST  PAS LE MEME QUE LE PRECEDENT AFFICHéé
*/
										if(!isset($_SESSION["previousEV"])){?>
                                            <div class="comments"  media="<?php echo $ev?>"><?php
                                                $lesCommentaires=getComs($ev);?>
                                                <ul><?php
                                                foreach ($lesCommentaires as $unCom) {
                                                    $tof=getTofProfil($unCom[2]);
                                                    $tof=$tof[0][0];
                                                    echo "<li media='".$unCom[0]."'><img src='$tof' width='30px' height='30px'><a>" .$unCom[3]."</a></li>";
                                                }?>
                                            </ul>
                                            </div>
											<div class='publication'><a name='profilFriend' id='<?php echo $id?>'>
                                                <?php echo $pers?></a><?php echo " a publi&#233 le ".$time."</a><br>";
                                                $youtube=strpos($libelle, "watch?v=");
                                                if($youtube!== false){
                                                    $p=strpos($libelle, "v=");
                                                    $p=substr($libelle, $p+2);?>
                                                    <div class='contenu'><?php
                                                        echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                    </div><br>
                                                    <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                }else{?>
                                                    <div class='contenu'><?php
                                                        echo $libelle;?>
                                                    </div><br><?php
                                                }
												$docs=getDoc($ev);
												if (!empty($docs)) {
													if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
														<a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
													}
													if (strtolower($docs[0][2])==".do") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
													}
													if (strtolower($docs[0][2])==".xl") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
													}
													if (strtolower($docs[0][2])==".pp") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
													}
												}
												$req=getLike($ev);?>
												<input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
                                                <input type="hidden" name="idUser" value="<?php echo $id ?>">
												<div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
													$like=getLike($ev);
													if(!empty($like)){
														$like=$like[0][0];
														echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";
													}?>
												</div>
												<!--fermeture div publication -->	
											</div><?php
										}else{
											/**
													SINON SI LEVENEMENT EST LE MEME QUE LE PRECEDENT AFFICHé 
*/
											unset($_SESSION["previousEV"]);
										}
									}		
								}/**
									  STOP SI MES EVENEMENT ET CEUX DE MES AMIS 
								*/
                                      /**
                                     SINON SI MES EVENEMENT
                                */
							}else{
                                if ($anEv[1]==$_SESSION["cle"]) {
                                    $ev=$anEv[0];
                                    $id=$anEv[1];
                                    $time=$anEv[2];
                                    $libelle=$anEv[3];
                                    $etat=$anEv[6];
                                    //personne
                                    $user=getUser($id);
                                    $pers=$user[0][2].' '.$user[0][1];
                                    //
                                    /**
                                        SI L ETAT EST PRIVÉÉ
*/
                                    if ($etat==2) {
                                    /**
                                        SI c'est mon EVENEMENT
*/
                                        if ($id==$_SESSION["cle"]) {
                                            if(!isset($_SESSION["previousEV"])){?>
                                                <div class="comments" media="<?php echo $ev?>"><?php
                                                    $lesCommentaires=getComs($ev);?>
                                                    <ul><?php
                                                        foreach ($lesCommentaires as $unCom) {
                                                            $tof=getTofProfil($unCom[2]);
                                                            $tof=$tof[0][0];
                                                            echo "<li media='".$unCom[0]."'><img src='$tof' width='30px' height='30px'><a>" .$unCom[3]."</a></li>";
                                                        }?>
                                                    </ul>
                                                </div>
                                                <div class='publication'><a name='profilFriend' id='<?php echo $id?>'>
                                                    <?php echo $pers?></a><?php echo " a publi&#233 le ".$time."</a><br>";
                                                   $youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenu'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenu'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
                                                    $docs=getDoc($ev);
                                                                            /**
                                        SI MON EVENEMENT A UN DOCUMENT
*/
                                                    if (!empty($docs)) {
                                                        if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
                                                            <a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
                                                        }
                                                        if (strtolower($docs[0][2])==".do") {?>
                                                            <a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
                                                        }
                                                        if (strtolower($docs[0][2])==".xl") {?>
                                                            <a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
                                                        }
                                                        if (strtolower($docs[0][2])==".pp") {?>
                                                            <a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
                                                        }
                                                    }
                                                    $_SESSION["previousEV"]=$ev;                                /**
                                        FIN SI  mon EVENEMENT A UN DOCUMENT
*/?>
                                                    <input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
                                                    <input type="hidden" name="idUser" value="<?php echo $id;?>">
                                                    <div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
                                                        $like=getLike($ev);
                                                        $like=$like[0][0];
                                                        echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
                                                    </div>
                                                    
                                                    <!--fermeture div publication -->   
                                                </div><?php
                                            }else{
                                                unset($_SESSION["previousEV"]);
                                            }
                                        }
                                        /**
                                                STOP SI C4EST MON EVENEMENT
                                        */
                                    }else{
                                            /**
                                        SI ETAT EVENEMENT PUBLI OU RESERVE AUX AMIS 
                                        SI LEVENEMENT N'EST  PAS LE MEME QUE LE PRECEDENT AFFICHéé
*/
                                        if(!isset($_SESSION["previousEV"])){?>
                                            <div class="comments" media="<?php echo $ev?>"><?php
                                                $lesCommentaires=getComs($ev);?>
                                                <ul><?php
                                                    foreach ($lesCommentaires as $unCom) {
                                                        $tof=getTofProfil($unCom[2]);
                                                        $tof=$tof[0][0];
                                                        echo "<li media='".$unCom[0]."'><img src='$tof' width='30px' height='30px'><a>" .$unCom[3]."</a></li>";
                                                    }?>
                                                </ul>
                                            </div>
                                            <div class='publication'>
                                                <a name='profilFriend' id='<?php echo $id?>'>
                                                    <?php echo $pers?></a><?php echo " a publi&#233 le ".$time."</a><br>";
                                                $youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenu'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenu'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
                                                $docs=getDoc($ev);
                                                if (!empty($docs)) {
                                                    if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
                                                        <a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
                                                    }
                                                    if (strtolower($docs[0][2])==".do") {?>
                                                        <a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
                                                    }
                                                    if (strtolower($docs[0][2])==".xl") {?>
                                                        <a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
                                                    }
                                                    if (strtolower($docs[0][2])==".pp") {?>
                                                        <a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
                                                    }
                                                }
                                                $req=getLike($ev);?>
                                                <input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
                                                <input type="hidden" name="idUser" value="<?php echo $id ?>">
                                                <div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
                                                    $like=getLike($ev);
                                                    if(!empty($like)){
                                                        $like=$like[0][0];
                                                        echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";
                                                    }?>
                                                </div>
                                                <!--fermeture div publication -->   
                                            </div><?php
                                        }else{
                                            /**
                                                    SINON SI LEVENEMENT EST LE MEME QUE LE PRECEDENT AFFICHé 
*/
                                            unset($_SESSION["previousEV"]);
                                        }
                                    }       
                                }
                            }
						}?>
					<!--fermeture div corps -->	
					</div>
					<!--fermeture div menuprincipal -->	
				</div>
                <?php
			}else{
		/**
						NO CONNECXION / SI ISSET FORMULAIRE DE CONNEXION
*/
				?><?php
				if (isset($_POST['valider'])) {
					$user=connect(htmlentities($_POST["email"]),htmlentities($_POST["pword"]));
								/**
									SI EXISTE CETTE PERSONNE
*/
					if(!empty($user)){?>
						<script>
						function chooseFile() {
      						document.getElementById("fileToUpload").click();
   						}
                        function chooseTofProfl() {
                            document.getElementById("imgToUpload").click();
                        }
                        $(function(){
                            $("input[name=imgToUpload]").click(function(){
                                setTimeout(function() {
                                    var formData = new FormData($('form#b')[0]);
                                    $.ajax({
                                        url: "index.php?uc=setImgProfil",
                                        type: 'POST',
                                        data: formData,
                                        async: false,
                                        success: function (data) {
                                            if($("input[type=file]").val()!=""){
                                                $( "#tofProfil" ).html("");
                                                $( "#tofProfil" ).html( data );
                                            } 
                                        },
                                        cache: false,
                                        contentType: false,
                                        processData: false
                                    });
                                    return false;
                                }, 5000);
                            });
                            $("input[id=fileToUpload]").click(function() {
                                 $('#annexe').html('<center><img src="source/ajax-loader.gif"></center>');
                                    setTimeout(function() {
                                        $('#annexe').html('<img src="source/ajax-loader.gif">');
                                        var formData = new FormData($('form#a')[0]);
                                        $.ajax({
                                            url: "index.php?uc=seeUploadFile",
                                            type: 'POST',
                                            data: formData,
                                            async: false,
                                            success: function (data) {
                                                $( "#annexe" ).html( data );
                                            },
                                            cache: false,
                                            contentType: false,
                                            processData: false
                                        });
                                        return false;
                                    }, 5000);
                            })
							$("form#a").submit(function(){
    							var formData = new FormData($(this)[0]);
    							$.ajax({
       								url: "index.php?uc=ev",
      								type: 'POST',
       								data: formData,
        							async: false,
        							success: function (data) {
										$( "#corps" ).html( data );
        							},
 		     						cache: false,
        							contentType: false,
        							processData: false
    							});
  		 	 					return false;
							});
							$('a[name=ajouterAmis]').click(function() {
								$('#menuPrincipal').html('<center><form action="index.php?uc=friends" method="POST"><b>RECHERCHER UN AMIS</b><br><input type="text" class="prenom" name="fNameFriend" id="fNameFriend" required="required"><br><input type="text" id="nameFriend" name="nameFriend" class="nom"><br><input type="submit" value="recherche"  name="search"></br></form></center>');
							});
							$('a[name=filActualite]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php');
							});
							$('a[name=profil]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=profil&id=<?php echo $user[0][0];?>');
							});
							$('a[name=mesAmis]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=friends');
							});
							$('a[name=message]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=msg');
							});
							//Publication);	
							$('input[name=prive]').click(function() {
								$(this).attr("checked","");
								$('input[name=amis]' ).removeAttr("checked");
								$('input[name=public]' ).removeAttr("checked");
							});
							$('input[name=amis]').click(function() {
								$(this).attr("checked","");
								$('input[name=prive]' ).removeAttr("checked");
								$('input[name=public]' ).removeAttr("checked");
							});
							$('input[name=public]').click(function() {
								$(this).attr("checked","");
								$('input[name=amis]' ).removeAttr("checked");
								$('input[name=prive]' ).removeAttr("checked");
							});
                            var showComs=0;
                        var modifCom=0;
                        $('.publication').hover(function(){
                            var taille=$(this).height()-20;
                            $('.comments').hover(function() {
                                $(this).css('height',taille);
                                $(this).css("box-shadow","0px 0px 10px black");
                                $(this).dblclick(function(){
                                    if (showComs==0) {
                                        var ev= $(this).attr("media");
                                        $(this).prepend('<div id="comentDiv"><textarea name="comentText" id="comentText" media="'+ev+'"  onmousemove="return false"></textarea></div>');
                                        $('#comentText').focus();
                                    }
                                    showComs=1;
                                });
                                $('.comments').keypress(function(event){
                                    if(event.keyCode == 13){
                                        var commentaire=$(this).find("#comentText").val();
                                        var id=$(this).attr("media");
                                        addComs(id,commentaire);
                                        $('#comentText').remove();
                                        if (commentaire!="undefined" && commentaire!="" &&  showComs==1 ) {
                                            $(this).find("ul").append('<li media="'+id+'"><img src="<?php echo $_SESSION["tof"]?>" height="30px" width="30px"><a> '+commentaire+'</a></li>');
                                            showComs=0;                                        
                                        };
                                    }
                                });
                                $('.comments li').dblclick(function(){
                                    if($('a[name=profilFriend]').attr("id")==<?php echo $_SESSION['cle']?>){
                                        var idCom=$(this).attr("media");
                                        if(confirm('Votre commentaire va être supprimé')){
                                            delComs(idCom);
                                            $(this).remove();
                                        }
                                    }
                                });
                                /*
                                $('.comments li').click(function(){
                                    $("#comentText").remove();
                                    var id=$(this).attr("id");
                                    var text=$(this).find("a").html();
                                    $(this).replaceWith('<textarea name="comentText" id="'+id+'" onmousemove="return false" >'+text+'</textarea>');
                                    $("textarea[name=comentText]").focus();
                                     modifCom=1;
                                });
                                if (modifCom==1) {
                                    $('.comments').click(function(){
                                        var id=$(this).find('textarea[name=comentText]').attr("media");
                                        var newText=$(this).find("textarea[name=comentText]").html();
                                        alterComs(id,newText);
                                        $(this).find("textarea[name=comentText]").remove();
                                        $(this).find("ul").append('<li id="'+id+'"><a>'+newText+'</a></li>');
                                        modifCom=0;
                                    });
                                }*/
                            },function(){
                                if (showComs==0) {
                                    $(this).css("box-shadow","0px 0px 0px");
                                    $("#comentDiv").remove();
                                };
                                showComs=0;
                            });
                        },function(){
                            showComs=0;
                        });
                        $('.publication').click(function(){
                            if( showComs==0) {
                                $(this).find('.comments').css("box-shadow","0px 0px 0px");
                               $(this).find("#comentDiv").remove();
                                showComs=1;
                           }
                        });
						});
    					</script>
    					<?php
						isconect($user[0][0],$user[0][1],$user[0][2],$user[0][4]);
                        $tof=getTofProfil($_SESSION["cle"]);
                        if (!empty($tof)) {
                            $_SESSION["tof"]=$tof[0][0];
                        }
						coPersonne($_SESSION["cle"]);?>
						<div id="user">
                            <div id="tofProfil"><?php 
                                $getTof=getTofProfil($_SESSION["cle"]);
                                if ($getTof[0][0]!="") {
                                    $getTof=$getTof[0][0];?>
                                    <img src="<?php echo $getTof?>" height="75px" width="90px"><?php
                                }else{?>
                                    <form id="b">
                                        <div style="height:0px;overflow:hidden">
                                            <input type="file" name="imgToUpload" id="imgToUpload"></input>
                                        </div>
                                        <img src="source/user.png" class="photoProfil" onclick="chooseTofProfl();">
                                        <input type="hidden" name="id" value="<?php echo $_SESSION['cle']?>">
                                    </form><?php
                                }?>
                            </div>
                            <?php   
                            echo $_SESSION["prenom"].' '.$_SESSION["nom"]."</br></br>";
                            $friends=sizeof(getFriends($_SESSION["cle"]));
                            echo $friends." amis</br>";
                            $msgNoRead=sizeof(getMsgNoRead($_SESSION["cle"]));
                            if ($msgNoRead=='0') {  
                                echo $msgNoRead." message(s) non lu(s)";
                            }else{
                                echo "<b><font color='red'>".$msgNoRead."</font></b> message(s) non lu(s)";
                            }?>
                            <form action="index.php?uc=Deconnexion" method="POST"><input type="submit" name="deco" value="Deconnexion"></form>
                        </div>
						<?php		/**
							AJOUT MENU GAUCHE
*/?>
						<div id="menuGauche">
							<a name="filActualite">Fil d'actualit&#233;</a><br>
							<a name="profil">Mon profil</a><br>
							<a name="mesAmis">Mes amis</a></br>
							<a name="ajouterAmis">Ajouter un amis</a><br>
							<a name="message">Messages</a><br>
						</div>
						<?php		/**
								STOP
*/?>
						<div id="message"></div>
						<div id="menuPrincipal"><div id ="talk">M'exprimer</div>
							<?php		/**
				AJOUT MENU PRINCIPAL   ANEXXE  STATUT 
*/?>
						<div id="annexe"></div>
						FIL D'actualit&#233;
						<div id="statut">
    							<?php		/**
											STOP J
*/?>
							<form id="a">
								<textarea id="text" onmousedown="this.onmousemove='return false';"></textarea>
									<div style="height:0px;overflow:hidden">
  										<input type="file" name="fileToUpload" id="fileToUpload"></input>
									</div>
								<img src="source/tof.png" class="photo" onclick="chooseFile();">
								<INPUT type="checkbox" name="prive" value="2"> Priv&#233;
								<INPUT type="checkbox" name="amis" value="1"> Amis seulement
								<INPUT type="checkbox" name="public" value="0" checked> Public
								<input type="hidden" id="id" value="<?php echo $_SESSION['cle']?>">
    							<button>submit</button>
							</form>
						</div>
						<?php		/**
						STOP DIV STATUT 
*/?>
						<div id="corps"><?php
							$req=getEv();
							$friend=getFriends($_SESSION["cle"]);
						/**

*/
							foreach ($req as $anEv) {
								if (in_array($anEv[1], $friend[0]) || $anEv[1]==$_SESSION["cle"]) {
									$ev=$anEv[0];
									$id=$anEv[1];
									$time=$anEv[2];
									$libelle=$anEv[3];
									$etat=$anEv[6];
									//personne
									$user=getUser($id);
									$pers=$user[0][2].' '.$user[0][1];
										//
										/**

*/
									if ($etat==2) {
										if ($id==$_SESSION["cle"]) {?>
                                            <div class="comments" media="<?php echo $ev?>"><?php
                                                $lesCommentaires=getComs($ev);?>
                                                <ul><?php
                                                    foreach ($lesCommentaires as $unCom) {
                                                        $tof=getTofProfil($unCom[2]);
                                                        $tof=$tof[0][0];
                                                        echo "<li media='".$unCom[0]."'><img src='$tof' width='30px' height='30px'><a>" .$unCom[3]."</a></li>";
                                                    }?>
                                                </ul>
                                            </div>
											<div class='publication'>
                                                <a name='profilFriend' id='<?php echo $id?>'>
                                                    <?php echo $pers?></a><?php echo " a publi&#233 le ".$time."</a><br>";
												$youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenu'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenu'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
												$docs=getDoc($ev);
												if (!empty($docs)) {
													if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
														<a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
													}
													if (strtolower($docs[0][2])==".do") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
													}
													if (strtolower($docs[0][2])==".xl") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
													}
													if (strtolower($docs[0][2])==".pp") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
													}
													$_SESSION["previousEV"]=$ev;
												}?>
												<input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
												<div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
													$like=getLike($ev);
													$like=$like[0][0];
													echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
												</div>
												<!--fermeture div publication -->	
											</div><?php
										}
									}
											/**

*/
									if(!isset($_SESSION["previousEV"])){?>
                                        <div class="comments" media="<?php echo $ev?>"><?php
                                                    $lesCommentaires=getComs($ev);?>
                                                    <ul><?php
                                                        foreach ($lesCommentaires as $unCom) {
                                                            $tof=getTofProfil($unCom[2]);
                                                            $tof=$tof[0][0];
                                                            echo "<li media='".$unCom[0]."'><img src='$tof' width='30px' height='30px'><a>" .$unCom[3]."</a></li>";
                                                        }?>
                                                    </ul>
                                        </div>
										<div class='publication'><?php echo "<a href='index.php?uc=profil&id=$id'>".$pers."</a> a publi&#233 le ".$time."<br>";
											$youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenu'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenu'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
											$docs=getDoc($ev);
											if (!empty($docs)) {
												if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
													<a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
												}
												if (strtolower($docs[0][2])==".do") {?>
													<a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
												}
												if (strtolower($docs[0][2])==".xl") {?>
													<a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
												}
												if (strtolower($docs[0][2])==".pp") {?>
													<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
												}
											}
											$req=getLike($ev);?>
											<input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
											<div class="like" onclick="aime(<?php echo $ev;?>)"><?php
												$like=getLike($ev);
												$like=$like[0][0];
												echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
                                            </div>									<!--fermeture div publication -->	
										</div><?php
									}else{
												/**

*/
										unset($_SESSION["previousEV"]);
									}
								}else{
                                    if ($anEv[1]==$_SESSION["cle"]) {
                                        $ev=$anEv[0];
                                        $id=$anEv[1];
                                        $time=$anEv[2];
                                        $libelle=$anEv[3];
                                        $etat=$anEv[6];
                                        //personne
                                        $user=getUser($id);
                                        $pers=$user[0][2].' '.$user[0][1];
                                        //
                                    /**
                                        SI L ETAT EST PRIVÉÉ
*/
                                        if ($etat==2) {
                                    /**
                                        SI c'est mon EVENEMENT
*/
                                            if ($id==$_SESSION["cle"]) {
                                                if(!isset($_SESSION["previousEV"])){?>
                                                    <div class="comments" media="<?php echo $ev?>"><?php
                                                    $lesCommentaires=getComs($ev);?>
                                                    <ul><?php
                                                        foreach ($lesCommentaires as $unCom) {
                                                            $tof=getTofProfil($unCom[2]);
                                                            $tof=$tof[0][0];
                                                            echo "<li media='".$unCom[0]."'><img src='$tof' width='30px' height='30px'><a>" .$unCom[3]."</a></li>";
                                                        }?>
                                                    </ul>
                                                </div>
                                                    <div class='publication'><?php echo "<a href='index.php?uc=profil&id=$id'>".$pers."</a> a publi&#233 le ".$time."<br>";
                                                       $youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenu'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenu'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
                                                        $docs=getDoc($ev);
                                                                                /**
                                        SI MON EVENEMENT A UN DOCUMENT
*/
                                                        if (!empty($docs)) {
                                                            if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
                                                                <a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
                                                            }
                                                            if (strtolower($docs[0][2])==".do") {?>
                                                                <a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
                                                            }
                                                            if (strtolower($docs[0][2])==".xl") {?>
                                                                <a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
                                                            }
                                                            if (strtolower($docs[0][2])==".pp") {?>
                                                                <a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
                                                            }
                                                        }
                                                        $_SESSION["previousEV"]=$ev;                                /**
                                        FIN SI  mon EVENEMENT A UN DOCUMENT
*/?>
                                                        <input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
                                                        <input type="hidden" name="idUser" value="<?php echo $id;?>">
                                                        <div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
                                                            $like=getLike($ev);
                                                            $like=$like[0][0];
                                                            echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
                                                        </div>
                                                    <!--fermeture div publication -->   
                                                    </div><?php
                                                }else{
                                                    unset($_SESSION["previousEV"]);
                                                }
                                            }
                                        /**
                                                STOP SI C4EST MON EVENEMENT
                                        */
                                        }else{
                                            /**
                                        SI ETAT EVENEMENT PUBLI OU RESERVE AUX AMIS 
                                        SI LEVENEMENT N'EST  PAS LE MEME QUE LE PRECEDENT AFFICHéé
*/
                                            if(!isset($_SESSION["previousEV"])){?>
                                                <div class="comments" media="<?php echo $ev?>"><?php
                                                    $lesCommentaires=getComs($ev);?>
                                                    <ul><?php
                                                        foreach ($lesCommentaires as $unCom) {
                                                            $tof=getTofProfil($unCom[2]);
                                                            $tof=$tof[0][0];
                                                            echo "<li media='".$unCom[0]."'><img src='$tof' width='30px' height='30px'><a>" .$unCom[3]."</a></li>";
                                                        }?>
                                                    </ul>
                                                </div>
                                                <div class='publication'>
                                                    <a name='profilFriend' id='<?php echo $id?>'>
                                                        <?php echo $pers?></a><?php echo " a publi&#233 le ".$time."</a><br>";
                                                    $youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenu'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenu'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
                                                    $docs=getDoc($ev);
                                                    if (!empty($docs)) {
                                                        if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
                                                            <a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
                                                        }
                                                        if (strtolower($docs[0][2])==".do") {?>
                                                            <a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
                                                        }
                                                        if (strtolower($docs[0][2])==".xl") {?>
                                                            <a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
                                                        }
                                                        if (strtolower($docs[0][2])==".pp") {?>
                                                            <a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
                                                        }
                                                    }
                                                    $req=getLike($ev);?>
                                                    <input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
                                                    <input type="hidden" name="idUser" value="<?php echo $id ?>">
                                                    <div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
                                                        $like=getLike($ev);
                                                        if(!empty($like)){
                                                            $like=$like[0][0];
                                                            echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";
                                                        }?>
                                                    </div>
                                                <!--fermeture div publication -->   
                                                </div><?php
                                            }else{
                                            /**
                                                    SINON SI LEVENEMENT EST LE MEME QUE LE PRECEDENT AFFICHé 
*/
                                                unset($_SESSION["previousEV"]);
                                            }
                                        }       
                                    }
                                }
							}?>
								<!--fermeture div corps -->	
						</div>
								<!--fermeture div menuprincipal -->	
						</div><?php
					//fin connexion echouer
					}else{?>
                        <script>
                            $(function(){
                                $('body').load("index.php");
                            });
                            alert("Ces identifiants sont inconnus ou éronnés ");
                        </script><?php
					}
					//fin valider
							/**

*/
				}else{
					/**
					::::::::::::::: MOT DE PASS OUBLIER
					*/
					if (isset($_POST["answa"])) {
						$rep=md5($_POST["answa"]);
						$ask=$_POST["ask"];
						$req=answaQuestion($ask,$rep);
						if (!empty($req)) {
							$v=md5("KuV58PmaF0r");
							$temp=temp($ask,$rep,$v);
							echo "Votre mot de passe temporaire : KuV58PmaF0r";
						}
					}
							/**

*/?>
					<script type="text/javascript">
						$(function(){
							$('input[name=email]').focus();
							$('input[name=email]').keypress(function() {
								$(this).css("background","white");
							});

                            var i = true ;
							$('a[id=forget]').click(function() {
                                if(i){
                                    $("#infos").html('<form action="index.php?uc=forget" method="POST"><input type="text" class="dress" name="forget" required="required" ><input type="submit"><form>');    
                                    i=false;                                
                                }else{
                                    $("#infos").html('');
                                    i = true ;
                                }
							});
							$('#signup').click(function() {
          						$(this).replaceWith('<div id="signup"><form action="index.php?uc=signup" method="POST"><input type="text"  class="prenom" name="prenom" size ="20" maxlength="20" required="required"/><input type="text" class="nom" name="nom" size ="20" maxlength="20" required="required"/><input type="radio" name="sex" value="M" checked>M<input type="radio" name="sex" value="F"><a>F</a><input type="text" name="adresse" class="dressPost" size ="20" maxlength="500" required="required"/><input type="email" class="dress" name="dress" maxlength="255" size ="30" required="required"/><input type="email"  class="cdress" name="cdress" maxlength="255" size ="30" required="required"><input type="password"  class="mdp" name="mdp" size ="30" maxlength="50" required="required"><select name="sel"><option value="0">Quel est le nom de votre premier animal de compagn</option><option value="1">Quel est votre sport prefere</option><option value="2">Quel est le nom de votre marque prefere</><option value="3">Quel est votre livre prefere</option></select><input type="text" name="answa"><input type="submit" name="inscri"value="Signup"></form></div>');
                                $('#user').animate({height:"235px"});
        						$('input[name=prenom]').focus(function() {
          							$(this).css("background","white");
        						});
        						$('input[name=prenom]').focusout(function() {
          							if($(this).val()==''){
          								$(this).css('background-image', 'url(source/p.png)','no-repeat');	
          							}
        						});
        						$('input[name=nom]').focus(function() {
          							$(this).css("background","white");
        						});
        						$('input[name=nom]').focusout(function() {
        							if($(this).val()==''){
          								$(this).css('background-image', 'url(source/ndf.png)','no-repeat');
        							}
        						});
        						$('input[name=adresse]').focus(function() {
          							$(this).css("background","white");
        						});
        						$('input[name=adresse]').focusout(function() {
        							if($(this).val()==''){
          								$(this).css('background-image', 'url(source/dressPost.png)','no-repeat');
        							}
        						});
        						$('input[name=dress]').focus(function() {
          							$(this).css("background","white");
        						});
        						$('input[name=dress]').focusout(function() {
        							if($(this).val()==''){
          								$(this).css('background-image', 'url(source/dress.png)','no-repeat');
        							}
        						});
        						$('input[name=cdress]').focus(function() {
          							$(this).css("background","white");
        						});
        						$('input[name=cdress]').focusout(function() {
        							if($(this).val()==''){
          								$(this).css('background-image', 'url(source/cdress.png)','no-repeat');
        							}
        						});
        						$('input[name=mdp]').focus(function() {
          							$(this).css("background","white");
        						});
        						$('input[name=mdp]').focusout(function() {
        							if($(this).val()==''){
          								$(this).css('background-image', 'url(source/mdp.png)','no-repeat');
        							}
        						});
        						$('input[value=F]').click(function() {
									$(this).attr("checked","");
									$('input[value=M]' ).removeAttr("checked");
								});
								$('input[value=M]').click(function() {
									$(this).attr("checked","");
									$('input[value=F]' ).removeAttr("checked");
								});
        					});
							$('input[name]').click(function() {
								$('input[name=email]').focus(function() {
          							$(this).css("background","white");
        						});
								$('input[name=email]').click(function() {
          							$(this).css("background","white");
        						});
        						$('input[name=email]').focusout(function() {
        							if($(this).val()==""){
          								$(this).css('background-image', 'url(source/dress.png)','no-repeat');
        							}
        						});
        						$('input[name=pword]').focus(function() {
          							$(this).css("background","white");
        						});
								$('input[name=pword]').click(function() {
          							$(this).css("background","white");
        						});
        						$('input[name=pword]').focusout(function() {
        							if($(this).val()==""){
          								$(this).css('background-image', 'url(source/mdp.png)','no-repeat');
        							}
        						});
							});
        				});
    					</script>
					
						<div id="user">
						<form action="index.php" method="POST">
						<input type="text" id='email' name="email" class="dress" size="30" maxlength="255" required="required"><input type="checkbox" id="save" name="save">Keep session active</br>
						<input type="password" id='pword' name="pword" class="mdp" size="30" maxlength="50" required="required">
						<input type="submit" id='valider' name="valider" value="Log in"><br>
						<a id="forget">Mot de passe oubli&#233; </a>
						</form>
						<div id="signup"><p id="sign">Sign up</p></div>
						</div>
						<div id="infos"></div><audio src="source/Rebel.mp3" controls onvolumechange="alert()"></audio>
						<div id="menuPrincipal1">
							<div id="ev1"><?php
								$y=0;
								$allPub=getAllEvPublic();
								//Coupe le tableau en deux tableaux
								$data1=array_slice($allPub,0,count($allPub)/2);
								foreach ($data1 as $aPub) {
									$id=$aPub[0];
									$pers=$aPub[1];
									$time=$aPub[2];
									$libelle=str_replace('$spacebar$',' ',$aPub[3]);
									$etat=$aPub[5];?>
									<div class="publicationEv"><?php echo $time;
										 $youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenuEv'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenuEv'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
										$docs=getDoc($id);
										if (!empty($docs)) {
											if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
												<a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
											}
											if (strtolower($docs[0][2])==".do") {?>
												<a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
											}
											if (strtolower($docs[0][2])==".xl") {?>
												<a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
											}
											if (strtolower($docs[0][2])==".pp") {?>
												<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
											}
										}?>
										<div class="like"><?php 
											$like=getLike($id);
											$like=$like[0][0];
											echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
										</div>
									</div><?php
								}?>
							</div>
							<div id="ev2"><?php
							$data2=array_slice($allPub,count($allPub)/2,count($allPub));
							foreach ($data2 as $aPub1) {
								$id=$aPub1[0];
								$pers=$aPub1[1];
								$time=$aPub1[2];
								$libelle=str_replace('$spacebar$',' ',$aPub1[3]);
								$share=$aPub1[5];?>
								<div class="publicationEv"><?php echo $time; 
								 $youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenuEv'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenuEv'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
								$docs=getDoc($id);
								if (!empty($docs)) {
									if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
										<a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
									}
									if (strtolower($docs[0][2])==".do") {?>
										<a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
									}
									if (strtolower($docs[0][2])==".xl") {?>
										<a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
									}
									if (strtolower($docs[0][2])==".pp") {?>
										<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
									}
								}?>
								<div class="like"><?php 
									$like=getLike($id);
									$like=$like[0][0];
									echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
								</div></div><?php
							}?>
							
						</div>
					</div>
						<?php
				}
						/**

*/
			}
			break;
		}/**

*/
		case 'friends':{?>
		<?php
					/**

*/
			if(estConnecte()==true){?>
				<div id="user"><?php
					echo $_SESSION["prenom"].' '.$_SESSION["nom"]."</br></br>";
					$friends=sizeof(getFriends($_SESSION["cle"]));
					echo $friends." amis</br>";
					$msgNoRead=sizeof(getMsgNoRead($_SESSION["cle"]));
					if ($msgNoRead=='0') {	
						echo $msgNoRead." message(s) non lu(s)";
					}else{
						echo "<b><font color='red'>".$msgNoRead."</font></b> message(s) non lu(s)";
					}?>
					<form action="index.php?uc=Deconnexion" method="POST"><input type="submit" name="deco" value="Deconnexion"></form>
				</div>
				<?php		/**

*/?>
				<script>
					$(function(){
						//Menu gauche
							$('a[name=ajouterAmis]').click(function() {
								$('#menuPrincipal').html('<center><form action="index.php?uc=friends" method="POST"><b>RECHERCHER UN AMIS</b><br><input type="text" class="prenom" name="fNameFriend" id="fNameFriend" required="required"><br><input type="text" id="nameFriend" name="nameFriend" class="nom"><br><input type="submit" value="recherche" name="search"></br></form></center>');
							});
							$('a[name=filActualite]').click(function() {
								$('body').load('index.php');
							});
							$('a[name=profil]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=profil&id=<?php echo $_SESSION["cle"] ?>');
							});
							$('a[name=mesAmis]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=friends');
							});
							$('a[name=message]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=msg');
							});
							$('a[name="profilFriend"]').click(function() {
								var i= $(this).attr('id');
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
       							$('body').load('index.php?uc=profil&id='+i);
							});
                            //Formulaire de recherche
                            $('input[name=fNameFriend]').focus(function() {
                                $(this).css("background","white");
                            });
                            $('input[name=fNameFriend]').focusout(function() {
                                if($(this).val()==''){
                                    $(this).css('background-image', 'url(source/p.png)','no-repeat');   
                                }
                            });
                            $('input[name=nameFriend]').focus(function() {
                                $(this).css("background","white");
                            });
                            $('input[name=nameFriend]').focusout(function() {
                                if($(this).val()==''){
                                    $(this).css('background-image', 'url(source/ndf.png)','no-repeat');
                                }
                            });
                            //
							$('a[title]').click(function() {
       				  			var param = 'idAmis=' + $(this).attr('id');
       							var id=$(this).attr('id');
          						$('#message').load('index.php?uc=Majax',param);
          						if($('#txt').length!==0){
         							$('#txt').replaceWith('<div id="txt"><form id="c"><input type="text" id="msg" name="msg" size ="30" onkeydown="if(event.keyCode==13){if(this.value!=null){}}"><input type="hidden" id="cleGeteur" value="'+id+'"></form></div>');
			       				}else{
        			  				$('body').append('<div id="txt"><input type="text" id="msg" name="msg" size ="30" onkeydown="if(event.keyCode==13){if(this.value!=null){}}"><input type="hidden" id="cleGeteur" value="'+id+'"></div>');
      		    				}
        					});
        					$('a[name=msgWaitFriend]').click(function() {
        						var id=$(this).attr('id');
								$('body').load('index.php?uc=msg&id='+id);
							});
					});
				</script>
				<?php		/**

*/?>
				<div id="menuGauche">
					<a name="filActualite">Fil d'actualit&#233;</a><br>
					<a name="profil">Mon profil</a><br>
					<a name="mesAmis">Mes amis</a><br>
					<a name="ajouterAmis">Ajouter un amis</a><br>
					<a name="message">Messages</a><br>
				</div>
				<?php		/**

*/?>
				<div id="message">
				</div><?php
				if (isset($_POST["search"])) {
						/**

*/?>
					<div id="menuPrincipal">
						<b>RECHERCHER UN AMIS</b><br>
						<center><form action="index.php?uc=friends&option=search" method="POST">	
						<input type="text" name="fNameFriend" id="fNameFriend" class ="prenom" require="require" value="<?php echo $_POST["fNameFriend"]?>"><br>
						<input type="text" id="nameFriend" name="nameFriend" class="nom" value="<?php echo $_POST["nameFriend"]?>"><br>
						<input type="submit" value="recherche" name="search"></br>
						</form></center><?php
						$nom=htmlspecialchars($_POST["nameFriend"]);
						$prenom=htmlspecialchars($_POST["fNameFriend"]);
						if ($_POST["nameFriend"]!="") {
									/**

*/
							$personnes=searchFriend($nom,$prenom);
							if (!empty($personnes)) {
										/**

*/
								foreach ($personnes as $unePers) {
									$nom=$unePers[2].' '.$unePers[1];
									$id=$unePers[0];?>
									<input type="hidden" id="id" value="<?php echo $id?>"><?php
									if($id!=$_SESSION["cle"]){
												/**

*/
										$isAFren=checkIfIsMyFriend($_SESSION["cle"],$id);
										if(empty($isAFren)){
											echo "$nom<br>";?><a href="index.php?uc=profil&id=<?php echo $id?>">Profil</a>&nbsp;<a href="index.php?uc=msg&id=<?php echo $id?>" >Message</a>
											<table>
												<tr>
													<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id; ?>"><input type="submit" name="add" value="Ajouter"></form></td>
												</tr>
											</table><?php
										}else{
											if($isAFren[1]!=1){
												echo "$nom<br>";?><a href="index.php?uc=profil&id=<?php echo $id?>">Profil</a>&nbsp;<a href="index.php?uc=msg&id=<?php echo $id?>"  >Message</a>
												<table>
													<tr>
														<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id; ?>"><input type="submit" name="add" value="Ajouter"></form></td>
													</tr>
												</table><?php
											}else{
												echo "$nom<br>";?><a href="index.php?uc=profil&id=<?php echo $id?>">Profil</a>&nbsp;<a href="index.php?uc=msg&id=<?php echo $id?>" >Message</a>
												<table>
													<tr>
														<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id?>"><input type="submit" name="add" value="Ajouter"></form></td>
														<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id?>"><input type="submit" name="reject" value="Refuser"></form></td>
													</tr>
												</table><?php
											}
										}	
									}else{
												/**

*/
										echo "$nom<br>";?><a href="index.php?uc=profil&id=<?php echo $id?>">Profil</a><?php
									}
								}
										/**

*/
							}else{
								echo "Aucun resultat";
							}
									/**

*/
						}else{
									/**

*/
							$personnes=searchFriendOnlyFname($prenom);
							if (!empty($personnes)){
										/**

*/
								foreach ($personnes as $unePers) {
									$nom=$unePers[2].' '.$unePers[1];
									$id=$unePers[0];?>
									<input type="hidden" id="id" value="<?php echo $id?>"><?php
									if($id!=$_SESSION["cle"]){
											/**

*/
										$isAFren=checkIfIsMyFriend($_SESSION["cle"],$id);
										if(empty($isAFren)){
													/**

*/?>
											<table>
													<tr>
														<td><a name="profilFriend" id="<?php echo $id?>"><?php echo $nom;?></a></td>
														<td><a name="msgWaitFriend" id="<?php echo $id?>">Message</a></td>
														<td><form action="index.php?uc=friends" method="POST">
																<input type="hidden" name="id" value="<?php echo $id; ?>">
																<input type="submit" name="add" value="Ajouter">
															</form></td>
													</tr><?php
										}else{
													/**

*/							
											if($isAFren[0][1]==2){?>
												<a name="profilFriend" id="<?php echo $id?>"><?php echo $nom;?></a>&nbsp;
												<a title="<?php echo $nom?>" id="<?php echo $id?>" >Message</a></br>
												<?php
											}
											if($isAFren[0][1]==1){
												if($isAFren[0][1]!=$_SESSION['cle']){
														/**

*/
													echo "$nom<br>";?><a href="index.php?uc=profil&id=<?php echo $id?>">Profil</a>&nbsp;<a href="index.php?uc=msg&id=<?php echo $id?>" >Message</a>
													<table>
														<tr>
															<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id?>"><input type="submit" name="add" value="Ajouter"></form></td>
															<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id?>"><input type="submit" name="reject" value="Refuser"></form></td>
														</tr>
													</table><?php
												}else{?>
													<a name="profilFriend" id="<?php echo $id?>"><?php echo $nom;?></a>&nbsp;(Demande en attente)
													<a name="msgWaitFriend" id="<?php echo $id?>">Message</a><?php
												}
											}
													/**

*/
										}	
									}else{
												/**

*/
										?><a name="profilFriend" id="<?php echo $id?>"><?php echo $nom;?></a><?php
									}
											/**

*/
								}
										/**

*/
							}else{
									/**

*/
								echo "Aucun resultat";
							}
						}?>
					</div><?php
				}else{?>
				<?php		/**

*/?>				<div id="infos"></div>
					<div id="menuPrincipal">
						<?php		/**

*/?>
						<script type="text/javascript">
							$(function(){
								$('p').click(function() {
       								$('#menuPrincipal').html('<center><form action="index.php?uc=friends" method="POST"><b>RECHERCHER UN AMIS</b><br><input type="text" class="prenom" name="fNameFriend" id="fNameFriend" required="required"><br><input type="text" id="nameFriend" name="nameFriend" class="nom"><br><input type="submit" value="recherche"  name="search"></br></form></center>');
								});
								$('a[name="profilFriend"]').click(function() {
									var i= $(this).attr('id');
       								$('body').load('index.php?uc=profil&id='+i);
								});
							});
    					</script>
    					<?php		/**

*/
    					if (isset($_POST["add"])) {
    						$isAFren=checkIfIsMyFriend($_SESSION["cle"],$_POST["id"]);
    						if (empty($isAFren)) {
								addFriend($_SESSION['cle'],$_POST["id"]);
    						}else{
    							echo "<div id='infos'>Vous etes d&#233;ja amis avec cette personne ou une demande à d&#233;ja &#233;t&#233; envoy&#233;<div>";
    						}
						}
								/**

*/
						if (isset($_POST["accept"])) {
							//Accepte la demande d'amis
							acceptFriend($_POST["id"],$_SESSION['cle']);
							//creer le nouvel amis 
							addFriend($_SESSION['cle'],$_POST["id"]);
							//Fais l'amis qui m'as demander en amis m'accepter à son tour
							acceptFriend($_SESSION['cle'],$_POST["id"]);
						}
								/**

*/
						if (isset($_POST["reject"])) {
							rejectFriend($_POST["id"],$_SESSION['cle']);
							rejectFriend($_SESSION['cle'],$_POST["id"]);
						}
								/**

*/
						if (isset($_GET["profil"])) {
							echo "Profil";
						}?>
						<?php		/**

*/?>
						<a><p>AJOUTER UN AMIS<p></a><br>
						<div id="otherFriend">
							<div id="waitFriend">
								<center><b>MES DEMANDES</b></br><?php
								$getWaitFriends=getWaitFriend($_SESSION["cle"]);
								foreach ($getWaitFriends as $ligne) {
									$cle_friend=$ligne[0];
									$user=getUser($cle_friend);
									$nom_friend=$user[0][2].' '.$user[0][1];?>									
									<a name="profilFriend" id="<?php echo $cle_friend?>"><?php echo $nom_friend?></a>&nbsp;<a title="<?php echo $cle_friend?>" id="<?php echo $cle_friend?>" >Message</a><br>(Demande envoy&#233;)<br>
									<?php
								}?>
							</div>
							<div id="askFriend">
								<center><b>MES FUTURE AMIS</b></center><br><?php
								$ask=getAskFriend($_SESSION["cle"]);
								foreach ($ask as $aNewF) {
									if ($aNewF[0]!=$_SESSION["cle"]) {
										$amis=getUser($aNewF[0]);
										$nom_friend=$amis[0][2].' '.$amis[0][1];
										echo "$nom_friend<br>";?><a href="index.php?uc=profil&id=<?php echo $aNewF[0]?>">Profil</a>&nbsp;<a href="index.php?uc=msg&id=<?php echo $aNewF[0]?>"  >Message</a>
										<input type="hidden" id="cle_get" value="<?php echo $aNewF[0]?>">
										<table>
											<tr>
												<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $aNewF[0]; ?>"><input type="submit" name="accept" value="Accepter"></form></td>
												<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $aNewF[0];?>"><input type="submit" name="reject" value="Refuser"></form></td>
											</tr>
										</table><?php	
									}
								}?>
							</div>
						</div>
						<?php		/**

*/?>
						<div id="friends"><?php
							$friends=getFriends($_SESSION["cle"]);
							echo "<center><b>MES AMIS</b></center><br>";
							foreach ($friends as $aFriend) {
								$unAmis=getUser($aFriend[0]);
								$nom_friend=$unAmis[0][1].' '.$unAmis[0][2];
								$cle_friend=$unAmis[0][0];?>
								<a name="profilFriend" id="<?php echo $cle_friend?>" ><?php echo $nom_friend?></a>&nbsp;<a title="<?php echo $nom_friend?>" id="<?php echo $cle_friend?>" >Message</a><br><?php
							}?>
						</div>
					</div><?php
							/**

*/
				}
			}else{?>
                <script>
                    $('body').load("index.php");
                </script><?php
			}
			break;
		}
        /**

*/
		case 'profil':{
/**

*/
			if(estConnecte()==true){
				$user=getUser($_GET["id"]);?>
					<div id="user"><?php	
						echo $_SESSION["prenom"].' '.$_SESSION["nom"]."</br></br>";
						$friends=sizeof(getFriends($_SESSION["cle"]));
						echo $friends." amis</br>";
						$msgNoRead=sizeof(getMsgNoRead($_SESSION["cle"]));
						if ($msgNoRead=='0') {	
							echo $msgNoRead." message(s) non lu(s)";
						}else{
							echo "<b><font color='red'>".$msgNoRead."</font></b> message(s) non lu(s)";
						}?>
						<form action="index.php?uc=Deconnexion" method="POST"><input type="submit" name="deco" value="Deconnexion"></form>
					</div><?php
/**

*/?>
					<div id="menuGauche">
						<a name="filActualite">Fil d'actualit&#233;</a><br>
						<a name="profil">Mon profil</a><br>
						<a name="mesAmis">Mes amis</a></br>
						<a name="ajouterAmis">Ajouter un amis</a><br>
						<a name="message">Messages</a><br>
					</div>
					<div id="message">
						<?php		/**

*/?>
					</div>
					<?php		/**

*/?>
					<div id="menuPrincipal"><?php if($_GET["id"]==$_SESSION['cle']){?><div id ="talk">M'exprimer</div><?php }?>
						<div id="annexe"></div>
						<div id="statut">
							<?php		/**

*/?>
							<script>
   								function chooseFile() {
      								document.getElementById("fileToUpload").click();
   								}
								$(function(){
									$('a[name=a]').click(function() {
										$('#menuPrincipal').html('<center><form action="index.php?uc=friends" method="POST"><b>RECHERCHER UN AMIS</b><br><input type="text" class="prenom" name="fNameFriend" id="fNameFriend" required="required"><br><input type="text" id="nameFriend" name="nameFriend" class="nom"><br><input type="submit" value="recherche"  name="search"></br></form></center>');
									});
									$("form#a").submit(function(){
    									var formData = new FormData($(this)[0]);
    									$.ajax({
        									url: "index.php?uc=ev",
        									type: 'POST',
        									data: formData,
        									async: false,
        									success: function (data) {
        										if($('textarea[name=text]').val()!=""){
														$( "#corps" ).html( data );
												}else{
													alert("Il semble que cette publication est vide");
												}
        									},
        									cache: false,
        									contentType: false,
        									processData: false
    									});
  		 	 							return false;
									});
									//Menu gauche
									$('a[name=ajouterAmis]').click(function() {
										$('#menuPrincipal').html('<center><form action="index.php?uc=friends" method="POST"><b>RECHERCHER UN AMIS</b><br><input type="text" class="prenom" name="fNameFriend" id="fNameFriend" required="required"><br><input type="text" id="nameFriend" name="nameFriend" class="nom"><br><input type="submit" value="recherche"  name="search"></br></form></center>');
									});
									$('a[name=filActualite]').click(function() {
                                        $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
										$('body').load('index.php');
									});
									$('a[name=profil]').click(function() {
                                        $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
										$('body').load('index.php?uc=profil&id=<?php echo $_SESSION["cle"] ?>');
									});
									$('a[name=mesAmis]').click(function() {
                                        $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
										$('body').load('index.php?uc=friends');
									});
									$('a[name=message]').click(function() {
                                        $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
										$('body').load('index.php?uc=msg');
									});
									//chekbox
									$('input[name=prive]').click(function() {
										$(this).attr("checked","");
										$('input[name=amis]' ).removeAttr("checked");
										$('input[name=public]' ).removeAttr("checked");
									});
									$('input[name=amis]').click(function() {
										$(this).attr("checked","");
										$('input[name=prive]' ).removeAttr("checked");
										$('input[name=public]' ).removeAttr("checked");
									});
									$('input[name=public]').click(function() {
										$(this).attr("checked","");
										$('input[name=amis]' ).removeAttr("checked");
										$('input[name=prive]' ).removeAttr("checked");
									});
                                    $('.publication').dblclick(function(){
                                        var ev = $(this).find('input[name=cle_ev]').val();
                                        var pers = $(this).find('input[name=idUser]').val();
                                        if(pers==<?php echo $_SESSION["cle"]?>){
                                            if(confirm('Votre publication va être supprimé')){
                                                delEv(ev);
                                                $(this).remove();  
                                            }      
                                        }else{
                                            alert("Vous n'êtes pas l'éditeur de cette publication");
                                        }
                                    });
                                    var like=0;
                                    $('#like').click(function() {
                                        if (like==0) {
                                            u = parseInt($("#nbrLike").html());
                                            $("#nbrLike").html(u+1);
                                            like=1;
                                        }else{
                                            if ($("#nbrLike").html()!=0) {  
                                                u = parseInt($("#nbrLike").html());
                                                $("#nbrLike").html(u-1);
                                                like=0;
                                            };
                                        }
                                    });
                                    var showComs=0;
                       //var modifCom=0;
                        $('.publication').hover(function(){
                            var taille=$(this).height()-20;
                            $('.comments').hover(function() {
                                $(this).css('height',taille);
                                $(this).css("box-shadow","0px 0px 10px black");
                                $(this).dblclick(function(){
                                    if (showComs==0) {
                                        var ev= $(this).attr("media");
                                        $(this).prepend('<div id="comentDiv"><textarea name="comentText" id="comentText" media="'+ev+'"  onmousemove="return false"></textarea></div>');
                                        $('#comentText').focus();
                                    }
                                    showComs=1;
                                });
                                $('.comments').keypress(function(event){
                                    if(event.keyCode == 13){
                                        var commentaire=$(this).find("#comentText").val();
                                        var id=$(this).attr("media");
                                        addComs(id,commentaire);
                                        $('#comentText').remove();
                                        if (commentaire!="undefined" && commentaire!="" &&  showComs==1 ) {
                                            $(this).find("ul").append('<li media="'+id+'"><img src="<?php echo $_SESSION["tof"]?>" height="30px" width="30px"><a> '+commentaire+'</a></li>');
                                            showComs=0;                                        
                                        };
                                    }
                                });
                                $('.comments li').dblclick(function(){
                                    if($('a[name=profilFriend]').attr("id")==<?php echo $_SESSION['cle']?>){
                                        var idCom=$(this).attr("media");
                                        if(confirm('Votre commentaire va être supprimé')){
                                            delComs(idCom);
                                            $(this).remove();
                                        }
                                    }
                                });
                                /*
                                $('.comments li').click(function(){
                                    $("#comentText").remove();
                                    var id=$(this).attr("id");
                                    var text=$(this).find("a").html();
                                    $(this).replaceWith('<textarea name="comentText" id="'+id+'" onmousemove="return false" >'+text+'</textarea>');
                                    $("textarea[name=comentText]").focus();
                                     modifCom=1;
                                });
                                if (modifCom==1) {
                                    $('.comments').click(function(){
                                        var id=$(this).find('textarea[name=comentText]').attr("media");
                                        var newText=$(this).find("textarea[name=comentText]").html();
                                        alterComs(id,newText);
                                        $(this).find("textarea[name=comentText]").remove();
                                        $(this).find("ul").append('<li id="'+id+'"><a>'+newText+'</a></li>');
                                        modifCom=0;
                                    });
                                }*/
                            },function(){
                                if (showComs==0) {
                                    $(this).css("box-shadow","0px 0px 0px");
                                    $("#comentDiv").remove();
                                };
                                showComs=0;
                            });
                        },function(){
                            showComs=0;
                        });
                        $('.publication').click(function(){
                            if( showComs==0) {
                                $(this).find('.comments').css("box-shadow","0px 0px 0px");
                               $(this).find("#comentDiv").remove();
                                showComs=1;
                           }
                        });
								});
    						</script>
    						<?php		/**

*/?>
							<form id="a">
							<textarea name="text" onmousedown="this.onmousemove='return false';"></textarea>
							<div style="height:0px;overflow:hidden">
  								<input type="file" name="fileToUpload" id="fileToUpload"></input>
							</div>
							<img src="source/tof.png" class="photo" onclick="chooseFile();">
							<input type="hidden" value="<?php if (isset($_GET['id']) && !empty($_GET['id']) ) {echo $_GET['id'];}?>" name="id">
							<INPUT type="checkbox" name="prive" value="2"> Priv&#233;
							<INPUT type="checkbox" name="amis" value="1"> Amis seulement
							<INPUT type="checkbox" name="public" value="0" checked> Public
    						<button>submit</button>
							</form>
						</div>
						<?php		/**

*/?>
						<?php echo $user[0][2]." ".$user[0][1];
						$y=0;
						?>
						<div id="corps"><?php
							$req=getMyEv($_GET["id"]);
							foreach ($req as $unEv) {
								$id=$unEv[0];
								$pers=$unEv[1];
								$user=getUser($pers);
								$time=$unEv[2];
								$libelle=str_replace('$spacebar$',' ',$unEv[3]);
								$share=$unEv[5];
								$etat=$unEv[6];
                                $pers=$user[0][2].' '.$user[0][1];
									/**

*/
								if($etat==2 && $user[0][0]!=$_SESSION["cle"]){		
									//Evenement priv&#233;
								}else{?>
								<?php		/**

*/?>
                                    <div class="comments" media="<?php echo $id?>"><?php
                                        $lesCommentaires=getComs($id);?>
                                        <ul><?php
                                            foreach ($lesCommentaires as $unCom) {
                                                echo "<li media='".$unCom[0]."'><a>".$unCom[3]."</a></li>";
                                            }?>
                                        </ul>
                                    </div>
									<div class='publication'>
                                        <a name="profilFriend" id='<?php echo $id?>'><?php echo $pers;?></a><?php echo " a publi&#233 le ".$time."<br>";
									    $youtube=strpos($libelle, "watch?v=");
                                        if($youtube!== false){
                                            $p=strpos($libelle, "v=");
                                            $p=substr($libelle, $p+2);?>
                                            <div class='contenu'><?php
                                                echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                            </div><br>
                                            <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                        }else{?>
                                            <div class='contenu'><?php
                                                echo $libelle;?>
                                            </div><br><?php
                                        }
									    $docs=getDoc($id);
								        if (!empty($docs)) {
								            if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
	                                           <a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
										    }
										    if (strtolower($docs[0][2])==".do") {?>
                                                <a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
                                            }
                                            if (strtolower($docs[0][2])==".xl") {?>
                                                <a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
                                            }
										    if (strtolower($docs[0][2])==".pp") {?>
											     <a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
										    }
									   }?>
									   <input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $id;?>">
                                        <input type="hidden" name="idUser" value="<?php echo $pers ?>">
									   <div class="like" onclick="aime(<?php echo $id;?>)"><?php 
										  $like=getLike($id);
										  $like=$like[0][0];
										  echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
									   </div>
									</div><?php
								}
									/**

*/
							}?>
						</div>
					</div>
					<?php		/**

*/?>
					<?php
			}else{
						/**

*/
				include("index.php");
				exit;
			}
			break;
		}
			/**

*/
		case 'ev':{?>
            <script> 

                        var showComs=0;
                       //var modifCom=0;
                        $('.publication').hover(function(){
                            var taille=$(this).height()-20;
                            $('.comments').hover(function() {
                                $(this).css('height',taille);
                                $(this).css("box-shadow","0px 0px 10px black");
                                $(this).dblclick(function(){
                                    if (showComs==0) {
                                        var ev= $(this).attr("media");
                                        $(this).prepend('<div id="comentDiv"><textarea name="comentText" id="comentText" media="'+ev+'"  onmousemove="return false"></textarea></div>');
                                        $('#comentText').focus();
                                    }
                                    showComs=1;
                                });
                                $('.comments').keypress(function(event){
                                    if(event.keyCode == 13){
                                        var commentaire=$(this).find("#comentText").val();
                                        var id=$(this).attr("media");
                                        addComs(id,commentaire);
                                        $('#comentText').remove();
                                        if (commentaire!="undefined" && commentaire!="" &&  showComs==1 ) {
                                            $(this).find("ul").append('<li media="'+id+'"><img src="<?php echo $_SESSION["tof"]?>" height="30px" width="30px"><a> '+commentaire+'</a></li>');
                                            showComs=0;                                        
                                        };
                                    }
                                });
                                $('.comments li').dblclick(function(){
                                    if($('a[name=profilFriend]').attr("id")==<?php echo $_SESSION['cle']?>){
                                        var idCom=$(this).attr("media");
                                        if(confirm('Votre commentaire va être supprimé')){
                                            delComs(idCom);
                                            $(this).remove();
                                        }
                                    }
                                });
                                /*
                                $('.comments li').click(function(){
                                    $("#comentText").remove();
                                    var id=$(this).attr("id");
                                    var text=$(this).find("a").html();
                                    $(this).replaceWith('<textarea name="comentText" id="'+id+'" onmousemove="return false" >'+text+'</textarea>');
                                    $("textarea[name=comentText]").focus();
                                     modifCom=1;
                                });
                                if (modifCom==1) {
                                    $('.comments').click(function(){
                                        var id=$(this).find('textarea[name=comentText]').attr("media");
                                        var newText=$(this).find("textarea[name=comentText]").html();
                                        alterComs(id,newText);
                                        $(this).find("textarea[name=comentText]").remove();
                                        $(this).find("ul").append('<li id="'+id+'"><a>'+newText+'</a></li>');
                                        modifCom=0;
                                    });
                                }*/
                            },function(){
                                if (showComs==0) {
                                    $(this).css("box-shadow","0px 0px 0px");
                                    $("#comentDiv").remove();
                                };
                                showComs=0;
                            });
                        },function(){
                            showComs=0;
                        });
                        $('.publication').click(function(){
                            if( showComs==0) {
                                $(this).find('.comments').css("box-shadow","0px 0px 0px");
                               $(this).find("#comentDiv").remove();
                                showComs=1;
                           }
                        });




                $('.publication').dblclick(function(){
                    var ev = $(this).find('input[name=cle_ev]').val();
                    var pers = $(this).find('input[name=idUser]').val();
                    if(pers==<?php echo $_SESSION["cle"]?>){
                        if(confirm('Votre publication va être supprimé')){
                            delEv(ev);
                            $(this).remove();  
                        }      
                    }
                });
                        var like=0;
                        var user=$('input[name=idUser]').val();
                        $('.like').click(function() {
                            if (like==0 && user!=<?php echo $_SESSION['cle'];?>) {
                                u = parseInt($(this).find("#nbrLike").html());
                                $(this).find("#nbrLike").html(u+1);
                                $(this).find("td").css("color","rgb(254, 67, 101)");
                                like=1;
                            }else{
                                if ($(this).find("#nbrLike").html()!=0) {  
                                    u = parseInt($(this).find("#nbrLike").html());
                                    $(this).find("#nbrLike").html(u-1);
                                     $(this).find("td").css("color","rgb(203, 232, 107)"); 
                                    like=0;
                                };
                            }
                        });
            </script>
        <?php
				/**

*/
			if (isset($_POST)) {
	/**
										SI EVENEMENT SANS IMAGE 
*/
			// 0 Public | 1 Amis |2 priv&#233; 
				if ($_FILES["fileToUpload"]["name"]=='') {
												/**

*/
					$texte=htmlspecialchars((utf8_encode($_POST["text"])));
					if (isset($_POST['public'])){
						$secure=$_POST["public"];
					}
					if (isset($_POST['prive'])){
						$secure=$_POST["prive"];
					}
					if (isset($_POST['amis'])){
						$secure=$_POST["amis"];
					}
												/**

*/
					if($texte!=""){
						$req=addEv($_POST["id"],$date,$texte,0,$secure);
					}
												/**

*/						
					$lesEv=getEv();
					$friend=getFriends($_POST["id"]);
					$y=0;
					foreach ($lesEv as $anEv) {
												/**

*/
						if (in_array($anEv[1], $friend)  || $anEv[1]==$_POST["id"]) {
							$ev=$anEv[0];
							$id=$anEv[1];
							$time=$anEv[2];
							$libelle=$anEv[3];
							$etat=$anEv[6];
							//personne
							$user=getUser($id);
							$pers=$user[0][2].' '.$user[0][1];
							//
													/**

*/
							if ($etat==2) {
								if ($id==$_POST["id"]) {?>
                                    <div class="comments" media="<?php echo $ev?>"><?php
                                        $lesCommentaires=getComs($ev);?>
                                        <ul><?php
                                            foreach ($lesCommentaires as $unCom) {
                                                echo "<li media='".$unCom[0]."'><a>".$unCom[3]."</a></li>";
                                            }?>
                                        </ul>
                                    </div>
									<div class='publication'>
                                        <a name="profilFriend" id='<?php echo $id?>'><?php echo $pers;?></a><?php echo " a publi&#233 le ".$time."<br>";
	                                    $youtube=strpos($libelle, "watch?v=");
                                        if($youtube!== false){
                                            $p=strpos($libelle, "v=");
                                            $p=substr($libelle, $p+2);?>
                                            <div class='contenu'><?php
                                                echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                            </div><br>
                                            <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                        }else{?>
                                            <div class='contenu'><?php
                                                echo $libelle;?>
                                            </div><br><?php
                                        }
									    $docs=getDoc($ev);
														/**

*/									    if(!isset($_SESSION["previousEV"])){
									        if (!empty($docs)) {
										        if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
												    <a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
											    }
											    if (strtolower($docs[0][2])==".do") {?>
												    <a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
											    }
											    if (strtolower($docs[0][2])==".xl") {?>
												    <a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
											    }
											    if (strtolower($docs[0][2])==".pp") {?>
											      	<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
											    }
										    }
										    $_SESSION["previousEV"]=$ev;?>
										    <input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
                                            <input type="hidden" name="idUser" value="<?php echo $id ?>">
										    <div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
								                $like=getLike($ev);
								                $like=$like[0][0];
									            echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
										    </div>
										<!--fermeture div publication -->	
									</div><?php
									    }else{
							               unset($_SESSION["previousEV"]);
									    }
								}							/**

*/
							}else{
														/**

*/?>	
                                <div class="comments" media="<?php echo $ev?>"><?php
                                    $lesCommentaires=getComs($ev);?>
                                    <ul><?php
                                        foreach ($lesCommentaires as $unCom) {
                                            echo "<li media='".$unCom[0]."'><a>".$unCom[3]."</a></li>";
                                        }?>
                                    </ul>
                                </div>
								<div class='publication'>
                                    <a name="profilFriend" id='<?php echo $id?>'><?php echo $pers;?></a><?php echo " a publi&#233 le ".$time."<br>";
                                    $youtube=strpos($libelle, "watch?v=");
                                    if($youtube!== false){
                                        $p=strpos($libelle, "v=");
                                        $p=substr($libelle, $p+2);?>
                                        <div class='contenu'><?php
                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                        </div><br>
                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                    }else{?>
                                        <div class='contenu'><?php
                                            echo $libelle;?>
                                        </div><br><?php
                                    }
								    $docs=getDoc($ev);
								    if (!empty($docs)) {
																/**

*/
									   if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
										  <a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
									   }
									   if (strtolower($docs[0][2])==".do") {?>
										  <a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
									   }
									   if (strtolower($docs[0][2])==".xl") {?>
										  <a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
									   }
									   if (strtolower($docs[0][2])==".pp") {?>
										  <a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
									   }
								    }
														/**

*/
								    $req=getLike($ev);?>
    								<input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
                                    <input type="hidden" name="idUser" value="<?php echo $id ?>">
		  		  				    	<div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
									   	   $like=getLike($ev);
                                           $like=$like[0][0];
                                           echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
									   </div>
								<!--fermeture div publication -->	
								</div><?php
							}							/**
		
*/				
						}
					}
											/**

*/
				}else{	
											/**
							SINON SI EVENEMENT AVEC IMAGE
*/
					$texte=htmlspecialchars(utf8_encode($_POST["text"]));
					if (isset($_POST['public'])){
						$secure=$_POST["public"];
					}
					if (isset($_POST['prive'])){
						$secure=$_POST["prive"];
					}
					if (isset($_POST['amis'])){
						$secure=$_POST["amis"];
					}
/**
......................................................Traitement ajout document......................................
*/				
					$target_dir = "source/";
					$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
					$uploadOk = 1;
					$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					// Check if image file is a actual image or fake image
												/**

*/
					if(isset($_POST["text"]) && $_POST["text"]!="") {
						// Check file size
						if ($_FILES["fileToUpload"]["size"] > 5000000) {
    						echo "Désolé,votre fichier est trop volumineux.";
    						$uploadOk = 0;
						}
						// Allow certain file formats
						if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType !="doc"
						&& $imageFileType !="docx" && $imageFileType != "dot" && $imageFileType !="dotm" && $imageFileType !="dotx" && $imageFileType != "dotm" && $imageFileType !="docb"
						&& $imageFileType !="xls" && $imageFileType !="xlsx"&& $imageFileType !="ppt" && $imageFileType !="odt"
						&& $imageFileType !="pptx") {
    						echo "Format du document non pris en charge.";
    						$uploadOk = 0;
						}
													/**

*/
						// Check if $uploadOk is set to 0 by an error
						if ($uploadOk == 0) {
    						echo "Oups... Fichier trop grand pour être telecharg&#233;";
						// if everything is ok, try to upload file
						}else{
														/**

*/
    						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    							$lastDoc=getLastIdDoc();
    							if($lastDoc==0){
									$lastDoc=$lastDoc[0][0];		
    							}else{
									$lastDoc=0;
    							}
    							
								$req=addEv($_POST["id"],$date,$texte,$lastDoc,$secure);
								$ev=getLastIdEv();
								$ev=$ev[0][0];
								$type=strrchr($_FILES["fileToUpload"]["name"], '.');
								$addDoc=addDoc($ev,$type,$target_dir.$_FILES["fileToUpload"]["name"]);
								$req=getEv();
								$friend=getFriends($_POST["id"]);
								$y=0;						/**

*/
								foreach ($req as $anEv) {
																/**

*/
									if (in_array($anEv[1], $friend)  || $anEv[1]==$_POST["id"] ) {
										$ev=$anEv[0];
										$id=$anEv[1];
										$time=$anEv[2];
										$libelle=$anEv[3];
										$etat=$anEv[6];
										//personne
										$user=getUser($id);
										$pers=$user[0][2].' '.$user[0][1];
										//
																	/**

*/
										if ($etat==2) {
																		/**

*/
											if ($id==$_POST["id"]) {?>
                                                <div class="comments" media="<?php echo $ev?>"><?php
                                                    $lesCommentaires=getComs($ev);?>
                                                    <ul><?php
                                                        foreach ($lesCommentaires as $unCom) {
                                                            echo "<li media='".$unCom[0]."'><a>".$unCom[3]."</a></li>";
                                                        }?>
                                                    </ul>
                                                </div>
												<div class='publication'>
                                                    <a name="profilFriend" id='<?php echo $id?>'><?php echo $pers;?></a><?php echo " a publi&#233 le ".$time."<br>";
												    $youtube=strpos($libelle, "watch?v=");
                                                    if($youtube!== false){
                                                        $p=strpos($libelle, "v=");
                                                        $p=substr($libelle, $p+2);?>
                                                        <div class='contenu'><?php
                                                            echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                        </div><br>
                                                        <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                    }else{?>
                                                        <div class='contenu'><?php
                                                            echo $libelle;?>
                                                        </div><br><?php
                                                    }
												$docs=getDoc($ev);
																			/**

*/
												if (!empty($docs)) {
																				/**

*/
													if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
														<a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
													}
													if (strtolower($docs[0][2])==".do" || strtolower($docs[0][2])==".od") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
													}
													if (strtolower($docs[0][2])==".xl") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
													}
													if (strtolower($docs[0][2])==".pp") {?>
														<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
													}
													$_SESSION["previousEV"]=$ev;
												}?>
																	<?php		/**

*/?>											<input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
												<div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
													$like=getLike($ev);
													$like=$like[0][0];
													echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
												</div>
												<!--fermeture div publication -->	
												</div><?php
											}
										}
																	/**

*/
										if(!isset($_SESSION["previousEV"])){?>
															<?php		/**

*/?>                                        
                                            <div class="comments" media="<?php echo $ev?>"><?php
                                                $lesCommentaires=getComs($ev);?>
                                                <ul><?php
                                                    foreach ($lesCommentaires as $unCom) {
                                                        echo "<li media='".$unCom[0]."'><a>".$unCom[3]."</a></li>";
                                                    }?>
                                                </ul>
                                            </div>
											<div class='publication'>
                                                <a name="profilFriend" id='<?php echo $id?>'><?php echo $pers;?></a><?php echo " a publi&#233 le ".$time."<br>";
											     $youtube=strpos($libelle, "watch?v=");
                                                if($youtube!== false){
                                                    $p=strpos($libelle, "v=");
                                                    $p=substr($libelle, $p+2);?>
                                                    <div class='contenu'><?php
                                                        echo "<a href='".$libelle."' target=_blank>Youtube</a>";?>
                                                    </div><br>
                                                    <iframe width="300" height="315" src="//www.youtube.com/embed/<?php echo $p?>" frameborder="0" allowfullscreen></iframe><?php
                                                }else{?>
                                                    <div class='contenu'><?php
                                                        echo $libelle;?>
                                                    </div><br><?php
                                                }
											    $docs=getDoc($ev);
																	/**

*/
											if (!empty($docs)) {
																		/**

*/
												if (strtolower($docs[0][2])==".jp" || strtolower($docs[0][2])=="pn" || strtolower($docs[0][2])=="gi") {?>
													<a href="<?php echo $docs[0][3]?>"><img width="250px" heigth="400px"  src="<?php echo $docs[0][3]?>"></a><?php
												}
												if (strtolower($docs[0][2])==".do") {?>
													<a href="<?php echo $docs[0][3]?>"><img src="source/docx.png"></a><?php
												}
												if (strtolower($docs[0][2])==".xl") {?>
													<a href="<?php echo $docs[0][3]?>"><img src="source/xl.png"></a><?php
												}
												if (strtolower($docs[0][2])==".pp") {?>
													<a href="<?php echo $docs[0][3]?>"><img src="source/ppt.png"></a><?php
												}
											}
																		/**

*/?>
											<input type="hidden" name="cle_ev" id="cle_ev" value="<?php echo $ev;?>">
												<div class="like" onclick="aime(<?php echo $ev;?>)"><?php 
													$like=getLike($ev);
													$like=$like[0][0];
													echo "<table><tr><td><div id='nbrLike'>".$like."</div></td><td> j'aime</td></tr></table>";?>
												</div>
											<!--fermeture div publication -->	
											</div>
											<script>
												$(function(){
													$('input[name=fileToUpload]').html("");
													$('input[name=fileToUpload]').val()=0;
												});
											</script><?php
											unset($_FILES);
										}else{
																	/**

*/
											unset($_SESSION["previousEV"]);
										}
									}
								}
    						}else{
    														/**

*/
        						echo "Sorry, there was an error uploading your file.";
    						}
    												/**

*/
    					}
    										/**

*/
    				}
    											/**

*/
    			}
			}			
			break;
		}
									/**

*/
		case 'msg':{
													/**

*/?>
				<?php
										/**

*/
			if(estConnecte()){
				if(!isset($_GET["id"])){
					?>  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
					<div id="infos"></div>
					<div id="user"></div>
					<div id="menuGauche">
						<a name="filActualite">Fil d'actualit&#233;</a><br>
						<a name="profil">Mon profil</a><br>
						<a name="mesAmis">Mes amis</a></br>
						<a name="ajouterAmis">Ajouter un amis</a><br>
						<a name="message">Messages</a><br>
					</div>
									<?php		/**

*/?>
					<script type="text/javascript">
						$(function(){
							//Menu gauche
							$('a[name=ajouterAmis]').click(function() {
								$('#menuPrincipal').html('<center><form action="index.php?uc=friends" method="POST"><b>RECHERCHER UN AMIS</b><br><input type="text" class="prenom" name="fNameFriend" id="fNameFriend" required="required"><br><input type="text" id="nameFriend" name="nameFriend" class="nom"><br><input type="submit" value="recherche" name="search"></br></form></center>');
							});
							$('a[name=filActualite]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php');
							});
							$('a[name=profil]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=profil&id=<?php echo $_SESSION["cle"]?>');
							});
							$('a[name=mesAmis]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=friends');
							});
							$('a[name=message]').click(function() {
                                $("#menuPrincipal").html('<center><img src="source/waitimg.gif"></center>');
								$('body').load('index.php?uc=msg');
							});
							$('p[id]').click(function() {
								$("input[name=cle_geteur]").val($(this).attr('id'));
	       						var param = 'idAmis=' + $(this).attr('id');
    	      					var id=$(this).attr('id');
        	  					$('#message1').load('index.php?uc=Pajax',param);
                                $("button").removeAttr("disabled");
        					});
                            $("button").attr("disabled","disabled");
						});
    				</script>
    									<?php		/**

*/?>
					<div id="menuPrincipal"><center><b>MES MESSAGES</b></center><br>
					   <div id="message1" onclick="setToRead();">
					   </div>
					   <div id="text1">
										<?php		/**

*/?>
					   <form id="texto">
						  <input type="text" name="msg" onclick="setToRead()" maxlenth="255" size="60px">
						  <input type="hidden"  id="cle_geteur" name="cle_geteur" value="<?php if(isset($_GET['idAmis'])){echo $_GET['idAmis'];}?>">
						  <button>submit</button>
					   </form>
					   </div><?php		/**

*/?>
					   <div id='listMessage'><?php
					       $friends=getFriends($_SESSION["cle"]);
                            foreach ($friends as $aFriend) {
						  	   $unAmis=getUser($aFriend[0]);
							   $nom_friend=$unAmis[0][1].' '.$unAmis[0][2];
							   $cle_friend=$unAmis[0][0];
							   echo "<p id='$cle_friend'>$nom_friend<p><br>";
						    }?>
					   </div>
					</div><?php
										/**

*/
					if(!isset($_POST['cle'])){
						if (isset($_POST['friendAdd'])) {
							$user=getKeyUser($_POST['friendAdd']);
							$add=addFriend($_SESSION["cle"],$user[0][0]);
						}
							/**

*/
						if (isset($_POST['message'])){
							$data=explode('.', $_POST["message"]);
							$msg=htmlspecialchars($data[0]);
							$keyGeteur=htmlspecialchars($data[1]);
							$getKeySender= getKeyUser($_SESSION["mail"]);
							$keySender=$getKeySender[0][0];
													/**

*/
							if($data[0]!=""){
														/**

*/
								$wMsg=addMsg($keySender,$keyGeteur,$msg,$date);
								if (!$wMsg) {
									$rMsg=getMsg($keySender,$keyGeteur);
									foreach ($rMsg as $unMsg) {
										$msg=$unMsg[3];
										$time=substr($unMsg[4],11,8);
														/**

*/
										if($unMsg[1]==$keySender){
											echo "<div class='moi'><font size='2'>$time</font><br><br>";
										}else{
											echo "<div id='reponse'>$msg</div><font size='2'>$time</font><br><br>";
										}
									}
								}
														/**

*/
							}else{
													/**

*/
								$rMsg=getMsg($keySender,$keyGeteur);
								foreach ($rMsg as $unMsg) {
									$msg=$unMsg[3];
									$time=substr($unMsg[4],11,8);
									if($unMsg[1]==$keySender){
										echo "<div class='moi'>$msg</div><font size='2'>$time</font><br><br>";
									}else{
										echo "<div id='reponse'>$msg</div><font size='2'>$time</font><br><br>";
									}
								}
							}
													/**

*/
						}else{?>
										<?php		/**

*/?>
						
							<div id="message"></div>
											<?php		/**

*/?>
							<div id="user"><?php	
							echo $_SESSION["prenom"].' '.$_SESSION["nom"]."</br></br>";
							$friends=sizeof(getFriends($_SESSION["cle"]));
							echo $friends." amis</br>";
							$msgNoRead=sizeof(getMsgNoRead($_SESSION["cle"]));
							if ($msgNoRead=='0') {	
								echo $msgNoRead." message(s) non lu(s)";
							}else{
								echo "<b><font color='red'>".$msgNoRead."</font></b> message(s) non lu(s)";
							}?>
							<form action="index.php?uc=Deconnexion" method="POST"><input type="submit" name="deco" value="Deconnexion"></form>
							</div>
											<?php		/**

*/
						     
							if (isset($_REQUEST["id"])) {?>
								<div id="txt" >
								<input type="text" id="msg" size ="30" onfocus="setToReadA()" onkeydown="if(event.keyCode == 13){if(this.value!=''){sendMsg()};this.value='';element = document.getElementById('ms');
									element.scrollTop = element.scrollHeight;}">
								<input type="hidden" id="cleGeteur" value="<?php echo $_REQUEST['id'];$_SESSION['cleGeteur']=$_REQUEST['id'];?>">
								<input type="button" value="Send"  onclick="if(document.getElementById('msg').value!=''){document.getElementById('msg').value='';element = document.getElementById('message');
									element.scrollTop = element.scrollHeight;}">
								</div>
								<div id="menuPrincipal">
								<?php
								$keyGeteur=$_REQUEST["id"];
								$rMsg=getMsg($_SESSION["cle"],$keyGeteur);
								foreach ($rMsg as $unMsg) {
									$msg=$unMsg[3];
									$time=substr($unMsg[4],11,8);
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<div class='moi'>$msg</div><font size='2'>$time</font><br><br>";
									}else{
										echo "<div id='reponse'>$msg</div><font size='2'>$time</font><br><br>";
									}
								}?>
								</div><?php	
							}
												/**

*/
						}
					}else{				/**

*/
						$keyGeteur=$_POST['cle'];
						$getKeySender= getKeyUser($_SESSION["mail"]);
						$keySender=$getKeySender[0][0];
						$rMsg=getMsg($keySender,$keyGeteur);
						foreach ($rMsg as $unMsg) {
							$msg=$unMsg[3];
							$time=substr($unMsg[4],11,8);
							if($unMsg[1]==$keySender){
								echo "<div class='moi'>$msg</div><font size='2'>$time</font><br><br>";
							}else{
								echo "<div id='reponse'>$msg</div><font size='2'>$time</font><br><br>";
							}
						}
					}
											/**

*/
				}else{?>
					<div id="infos"></div>
					<div id="user"><?php	
						echo $_SESSION["prenom"].' '.$_SESSION["nom"]."</br></br>";
						$friends=sizeof(getFriends($_SESSION["cle"]));
						echo $friends." amis</br>";
						$msgNoRead=sizeof(getMsgNoRead($_SESSION["cle"]));
						if ($msgNoRead=='0') {	
							echo $msgNoRead." message(s) non lu(s)";
						}else{
							echo "<b><font color='red'>".$msgNoRead."</font></b> message(s) non lu(s)";
						}?>
						<form action="index.php?uc=Deconnexion" method="POST"><input type="submit" name="deco" value="Deconnexion"></form>
					</div>
					<div id="menuGauche">
							<a href="index.php">Fil d'actualit&#233;</a><br>
							<a href="index.php?uc=profil&id=<?php echo $_SESSION['cle']?>">Mon profil</a><br>
							<a href="index.php?uc=friends">Mes amis</a><br>
							<a name="a">Ajouter un amis</a><br>
							<a href="index.php?uc=msg">Messages</a><br>
					</div>
									<?php		/**

*/?>
					<script type="text/javascript">
						$(function(){
							$('a[name=a]').click(function() {
								$('#menuPrincipal').html('<center><form action="index.php?uc=friends" method="POST"><b>RECHERCHER UN AMIS</b><br><input type="text" class="prenom" name="fNameFriend" id="fNameFriend" required="required"><br><input type="text" id="nameFriend" name="nameFriend" class="nom"><br><input type="submit" value="recherche" name="search"></br></form></center>');
							});
							$('p[id]').click(function() {
								$("input[name=cle_geteur]").val($(this).attr('id'));
	       						var param = 'id=' + $(this).attr('id');
    	      					var id=$(this).attr('id');
        					});
        					$("form#texto").submit(function(){
                                var formData = new FormData($(this)[0]);
                                $.ajax({
        						  url: "index.php?uc=Pajax",
        						  type: 'POST',
        						  data: formData,
        						  async: false,
        						  success: function (data) {
        							if($('input[name=msg]').val()!=""){
											$( "#message1" ).html( data );
									}else{
										alert("Il semble que cette publication est vide");
									}
        						  },
        						  cache: false,
       							  contentType: false,
       							  processData: false
                                });
  		 	 				 return false;
                            });
						});
    				</script>
    									<?php		/**

*/?>
					<div id="menuPrincipal"><center><b>MES MESSAGES</b></center><br>
						<div id="message1" onclick="setToRead();">
						</div>
						<div id="text1">
										<?php		/**

*/?>
							<form id="texto">
								<input type="text" name="msg" onclick="setToRead()" maxlenth="255" size="60px">
								<input type="hidden"  id="cle_geteur" name="cle_geteur" value="<?php echo $_GET["id"] ?>">
								<button>submit</button>
							</form>
						</div><?php
						$id=$_GET["id"];
						$user=getUser($id);
						$friend=checkIfIsMyFriend($_SESSION["cle"],$id);
						if(!empty($friend)){
							if ($friend[0][1]==1 && $friend[0][2]==$_SESSION["cle"]) {
							 	echo "<p id='$id'>".$user[0][2]." ".$user[0][1]."</p>(Demande en attente) ";
							 }else{?>
							 	<table>
									<tr>
										<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id; ?>"><input type="submit" name="accept" value="Accepter"></form></td>
										<td><form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id;?>"><input type="submit" name="reject" value="Refuser"></form></td>
									</tr>
								</table><?php
							 }
						}else{
							echo "<p id='$id'>".$user[0][2]." ".$user[0][1]."</p> ne fait pas partie de vos amis ";?>
							 <form action="index.php?uc=friends" method="POST"><input type="hidden" name="id" value="<?php echo $id?>"><input type="submit" name="add" value="Ajouter"></form><?php
						}?>
					</div><?php
				}
				/**

				*/
			}else{?>
                <script>
                    $('body').load("index.php");
                </script><?php
			}
			break;
		}
								/**

*/
		case 'Majax':{?>
            <script>
                var cle=<?php echo $_SESSION['cle'];?>;
                $("."+cle).attr('class','moi');
                var id = $('input[id=cleGeteur]').val();

                $('input[name=msg]').keyup(function(event){
                    var message = $('#msg').val();
                    if(event.keyCode == 13){
                        sendMsg(id,message);
                    }
                });
                function afficheConversation() {
                    $('#message').load('index.php?uc=Majax&idAmis='+id);
                    $('#msg').val('');
                    $('#msg').focus();
                }
            //setInterval(afficheConversation, 4000);
            </script><?php
             if (isset($_GET['idAmis']) && !file_exists('conversation/'.$_GET["idAmis"].$_SESSION['cle'].'.htm')) {
                $path='conversation/'.$_GET["idAmis"].$_SESSION['cle'].'.htm';
                $pathTwo='conversation/'.$_SESSION['cle'].$_GET["idAmis"].'.htm';
                $d="";
                file_put_contents($path,$d);
                file_put_contents($pathTwo,$d);
             }
            if (isset($_POST["message"])){
                $cle=$_SESSION["cle"];   
                $msg =explode('#..#',$_POST["message"]); 
                $message= $msg[1];
                $id= $msg[0];
                if (!empty($message)) {
                    $user=getUser($cle);
                    $pseudo=$user[0][2];
                    $ligne = $pseudo.' > <div class="'.$cle.'">'.$message.'</div><br>'; 
                    $name='conversation/'.$id.$cle.'.htm'; 
                    $leFichier = file($name);             //On lit le fichier ac.htm et on stocke la réponse dans une variable (de type tableau)
                    $nbrLine=array_unshift($leFichier, $ligne);       //On ajoute le texte calculé dans la ligne précédente au début du tableau
                    file_put_contents($name, $leFichier);

                    $name='conversation/'.$cle.$id.'.htm';
                    $leFichier = file($name);             //On lit le fichier ac.htm et on stocke la réponse dans une variable (de type tableau)
                    $nbrLine=array_unshift($leFichier, $ligne);       //On ajoute le texte calculé dans la ligne précédente au début du tableau
                    file_put_contents($name, $leFichier);
                    setLastMsg($cle,$id,$nbrLine);
                }
            }
            if (isset($_GET['idAmis']) && file_exists('conversation/'.$_GET["idAmis"].$_SESSION['cle'].'.htm')) {
                include('conversation/'.$_GET["idAmis"].$cle.'.htm');
            }
										/**

*/
			
			break;
        }
		
        									/**

*/
		case 'Pajax':{
										/**

*/
			if(isset($_GET['idAmis'])){?>
								<?php		/**

*/?>
				<script>
					$(function(){
						var u=$("input[name=cle_geteur]").val()
   						$("form#texto").submit(function(){
   					    	var formData = new FormData($(this)[0]);
                            $.ajax({
                                url: "index.php?uc=Pajax",
                                type: 'POST',
               				    data: formData,
                                 async: false,
                                success: function (data) {
    					            if($('input[name=msg]').val()!=""){
						      		      $( "#message1" ).html( data );
								    }else{
									  alert("Il semble que cette publication est vide");
								    }
        						},
        						cache: false,
       						    contentType: false,
       							processData: false
                            });
                            return false;
  		 	 			});
  		 	 			$("a[name]").click(function(){
  		 	 				var i= $(this).attr('name');
  		 	 				var m= $("input[name=cle_geteur]").val();
  		 	 				$( "#message1" ).load("index.php?uc=nextPrevious&page="+i+"&idAmis="+m);
  		 	 			})
					});
					</script>
										<?php		/**

*/?>
					<?php 
					$keyGeteur=$_GET['idAmis'];
					$rMsg=getMsg($_SESSION["cle"],$keyGeteur);
					//Combien de fois tableau divis&#233;
					$m=count($rMsg)/6;
					//Combien de fois tableau divis&#233;
					$c=round($m,0);
					//Combien de ligne dans tableau
					$v=count($rMsg);
					if(!isset($_GET["page"])){
						$re=1;
					}else{
						$re=$_GET["page"];
					}?>
					<div id="pages"><?php
						for ($i=0; $i <$c; $i++) {?> 
							<a name="<?php echo $i+1?>"><?php echo $i+1?></a><?php 	
						}?>
					</div>
										<?php		/**

*/?>
					<?php			
					switch ($re) {
						case 1:{
							$lo=6*$re-6;
							$tab=array_slice($rMsg,$lo,6);
							foreach ($tab as $unMsg) {
								$msg=$unMsg[3];
								$time=explode('/',$unMsg[4]);
								$year=$time[0];
								$month=$time[1];
								$day=$time[2];
								$time=$day.'/'.$month.'/'.$year;
								if($unMsg[1]==$_SESSION["cle"]){
									echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
								}else{
									echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
								}
							}
							break;
						}
					}
												/**

*/
			}else{
											/**

*/
				if(isset($_POST['cle_geteur'])){
					$keyGeteur=$_POST['cle_geteur'];
					$text=$_POST['msg'];
					$add=addMsg($_SESSION["cle"],$keyGeteur,$text,$date);
					$rMsg=getMsg($_SESSION["cle"],$keyGeteur);
					foreach ($rMsg as $unMsg) {
						$msg=$unMsg[3];
						$time=substr($unMsg[4],11,8);
						if($unMsg[1]==$_SESSION["cle"]){
							echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
						}else{
							echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
						}
					}
				}else{
												/**

*/
					if (isset($_GET["page"])) {
						
						$keyGeteur=$_GET['idAmis'];
						$rMsg=getMsg($_SESSION["cle"],$keyGeteur);
						//Combien de fois tableau divis&#233;
						$m=count($rMsg)/6;
						//Combien de fois tableau divis&#233;
						$c=round($m,0);
						//Combien de ligne dans tableau
						$v=count($rMsg);
						if(!isset($_POST["page"])){
							$pe=1;
						}else{
							$pe=$_POST["page"];
						}?>
											<?php		/**

*/?>
						<div id="pages"><?php
						for ($i=0; $i <$c; $i++) {?> 
							<a name="<?php echo $i+1?>"><?php echo $i+1?></a><?php 	
						}?>
						</div>
											<?php		/**

*/?>
						<?php			
						switch ($pe) {
							case 1:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 2:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
									echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 3:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 4:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 5:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 6:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 7:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 8:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 9:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
							case 10:{
								$lo=6*$pe-6;
								$tab=array_slice($rMsg,$lo,6);
								foreach ($tab as $unMsg) {
									$msg=$unMsg[3];
									$time=explode('/',$unMsg[4]);
									$year=$time[0];
									$month=$time[1];
									$day=$time[2];
									$time=$day.'/'.$month.'/'.$year;
									if($unMsg[1]==$_SESSION["cle"]){
										echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
									}else{
										echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
									}
								}
								break;
							}
						}
												/**
									FIN if isset  $_POST["PAGE"] 
*/
					}
											/**

*/
					$keyGeteur=$_GET['refresh'];
					$rMsg=getMsg($_SESSION["cle"],$keyGeteur);
					foreach ($rMsg as $unMsg) {
						$msg=$unMsg[3];
						$time=substr($unMsg[4],11,8);
						if($unMsg[1]==$_SESSION["cle"]){
							echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
						}else{
							echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
						}
					}
												/**
									FIN SI NON isset $_POST['CLE_GETEUR']
*/
				}
											/**
				FIN SI NON ISSET $_GET["IdAmis"]
*/
			}
			
			break;
		}
								/**

*/
		case 'signup':{
										/**
						SI UTILISATEUR CONNECTéé
	*/	
			if (!estConnecte()) {
										/**
						SI FORMULAIRE EST ENVOYE
*/
				if (isset($_POST["inscri"])) {
					$nom=strtoupper(htmlentities(utf8_encode(ucwords($_POST["nom"])),ENT_QUOTES,'UTF-8'));
					$prenom=htmlentities(utf8_encode(ucwords($_POST["prenom"])),ENT_QUOTES,'UTF-8');
					$prenom=strtoupper(substr($prenom, 0,1)).substr($prenom,1,sizeof($prenom)+2);
					$adress=htmlentities(utf8_encode(ucwords($_POST["adresse"])),ENT_QUOTES,'UTF-8');					
					$mail=htmlentities(utf8_encode($_POST["dress"]),ENT_QUOTES,'UTF-8');
					$mdp=htmlentities(utf8_encode($_POST["mdp"]),ENT_QUOTES,'UTF-8');
					$sexe=htmlentities(($_POST["sex"]));
					$phrase=htmlentities(($_POST["sel"]));
					$reponse=htmlentities(utf8_encode($_POST["answa"]),ENT_QUOTES,'UTF-8');
					signup($nom,$prenom,$adress,$mail,$mdp,$sexe,$phrase,$reponse);
                    $req=getLastUser();
                    $key=$req[0][0];
                    coPersonne($key);
                    isconect($key,$nom,$prenom,$mail);
				}
										/**
									STOP
*/          ?>
                <script>
                    $(function(){
                        $("body").html('<center><img src="source/waitimg.gif"></center>');
                        $('body').load("index.php");
                    });
                </script><?php
			}else{
											/**
					SI NON UTILISATEUR CONECTEé	
*/?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
			}
			break;
		}
								/**
								CAS MOT DE PASS OUBLIé
*/
		case 'forget':{
			if (isset($_POST["forget"]) && !empty($_POST["forget"])) {
				$user=getUserMail($_POST["forget"]);
											/**

*/
					if (!empty($user)) {
						$q=getMyQuestion($user[0][0]);?>
						<form action="index.php" method="POST">
						<?php echo $q[0][1];?>
						<input type="text" name="answa" required="required">
						<input type="hidden" name="ask" value="<?php echo $q[0][0]?>">
						<input type="submit" value="envoyer">
						</form>	<?php
					}else{?>
										<?php		/**

*/?>
						<a href="index.php">Nous rencontrons actuellement des problèmes technique,veuillez nous excuser"</a><?php
					}
			}else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
			break;
		}
									/**

*/
		case 'nextPrevious':{
										/**

*/
			if (isset($_GET["page"])) {
				$keyGeteur=$_GET['idAmis'];
				$rMsg=getMsg($_SESSION["cle"],$keyGeteur);
				//Combien de fois tableau divis&#233;
				$m=count($rMsg)/6;
				//Combien de fois tableau divis&#233;
				$c=round($m,0);
				//Combien de ligne dans tableau
				$v=count($rMsg);
				if(!isset($_GET["page"])){
					$pe=1;
				}else{
					$pe=$_GET["page"];
				}?>	
									<?php		/**

*/?>
				<div id="pages"><?php
				for ($i=0; $i <$c; $i++) {?> 
					<a name="<?php echo $i+1?>"><?php echo $i+1?></a><?php 	
				}?>
				</div>
				<?php
											/**

*/			
				switch ($pe) {
					case 1:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 2:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 3:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 4:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 5:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 6:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 7:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 8:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 9:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
					case 10:{
						$lo=6*$pe-6;
						$tab=array_slice($rMsg,$lo,6);
						foreach ($tab as $unMsg) {
							$msg=$unMsg[3];
							$time=explode('/',$unMsg[4]);
							$year=$time[0];
							$month=$time[1];
							$day=$time[2];
							$time=$day.'/'.$month.'/'.$year;
							if($unMsg[1]==$_SESSION["cle"]){
								echo "<font size='2'>$time</font><div id='moi1'>$msg</div><br><br>";
							}else{
								echo "<font size='2'>$time</font><div id='reponse1'>$msg</div><br><br>";
							}
						}
						break;
					}
											/**

*/
				}
											/**

*/
			}else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
			break;
										/**

*/
		}
								/**

*/		
		case 'Deconnexion':{
										/**

*/
			if (isset($_POST["deco"])) {
				decoPersonne($_SESSION["cle"]);
                session_destroy();?>
                <script>
                    $(function(){
                        $("body").html('<center><img src="source/waitimg.gif"></center>');
                        $('body').load("index.php");
                    });
                </script><?php
			}else{?>
                <script>
                    $(function(){
                        $("body").html('<center><img src="source/waitimg.gif"></center>');
                        $('body').load("index.php");
                    });
                </script><?php
			}
			break;
		}
									/**

*/
		case 'aime':{
            if (!empty($_POST)) {
                if (isset($_POST["aime"])) {
                    $id=$_POST["aime"];
                    $verif=verifAime($id,$_SESSION["cle"]);
                    if (empty($verif)) {
                        $add=initLike($id,$_SESSION["cle"]);
                    }else{
                        $drop=unLike($id,$_SESSION["cle"]);
                    }
                }else{
                    if (isset($_POST["del"])) {
                        $id=$_POST["del"];
                        $del=delEv($id);?>
                        <script>
                            alert("Actualité supprimé avec succès(Refresh to show modif)");
                        </script><?php
                    } 
                }            
            }else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
			break;
		}
		case 'read' :{
			if (isset($_POST["id"])) {
				SetMsgToRead($_SESSION["cle"],$_POST["id"]);
			}else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
			break;
		}
		case 'seeUploadFile' :{?>
            <script>
                $(function(){
                    $('#uploadFile').click(function(){
                        if(confirm("Ce document va être supprimé")){
                            $('#annexe').html("");
                            $('input[type=file]').val("");    
                        }
                    });
                    $('#uploadFile').hover(function(){
                        $(this).fadeTo( "slow" , 0.9);
                    },
                        function(){
                        $(this).fadeTo("slow" , 1);
                        $('').replaceAll('div#delUploadFile');      
                    });
                    $( "#statut" ).show();
                    $( "#annexe" ).show();
                    $( "#corps" ).css("top","180px");
                    $( "#corps" ).css("height","275px");
                });
            </script>
            <?php
            if(!empty($_POST)){
                if (isset($_FILES) && $_FILES["fileToUpload"]["name"]!='') {
			 	   $target_dir = "source/";
				    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    				$uploadOk = 1;
	   	       		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		  		  // Check if image file is a actual image or fake image
											/**

*/
					// Check if file already exists
				    if (file_exists($target_file)) {
    				    $uploadOk = 2;
				    }
				    // Check file size
				    if ($_FILES["fileToUpload"]["size"] > 5000000) {?>
					   <script type="text/javascript">
						  alert("Désolé,votre fichier est trop volumineux.");
					   </script><?php
    				    $uploadOk = 0;
				    }
				    // Allow certain file formats
				    if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType !="doc"
				    && $imageFileType !="docx" && $imageFileType != "dot" && $imageFileType !="dotm" && $imageFileType !="dotx" && $imageFileType != "dotm" && $imageFileType !="docb"
				    && $imageFileType !="xls" && $imageFileType !="xlsx"&& $imageFileType !="ppt" && $imageFileType !="odt"
				    && $imageFileType !="pptx") {
    				    echo "Format du document non pris en charge.";
  	     				$uploadOk = 0;
		      		}
													/**

*/
				    // Check if $uploadOk is set to 0 by an error
				    if ($uploadOk == 0) {	
				    // if everything is ok, try to upload file
				    }else{
					   move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);?>
					   <div id='uploadFile'>
						  <img src="<?php echo $target_dir.$_FILES['fileToUpload']['name']?>" height='110px' width='130px'>
					   </div><?php
				    }								/**

*/	
                }
                /*
                if (isset($_POST["delUploadFile"])) {		
			     
                }*/
            }else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
			break;
		}
        case 'setImgProfil':{
            if(!empty($_POST)){
                $target_dir = "source/";
                $target_file = $target_dir . basename($_FILES["imgToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                                            /**

*/
                    // Check if file already exists
                if (file_exists($target_file)) {
                    $uploadOk = 2;
                }
                // Check file size
                if ($_FILES["imgToUpload"]["size"] > 5000000) {?>
                    <script type="text/javascript">
                        alert("Désolé,votre fichier est trop volumineux.");
                    </script><?php
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType !="doc"
                && $imageFileType !="docx" && $imageFileType != "dot" && $imageFileType !="dotm" && $imageFileType !="dotx" && $imageFileType != "dotm" && $imageFileType !="docb"
                && $imageFileType !="xls" && $imageFileType !="xlsx"&& $imageFileType !="ppt" && $imageFileType !="odt"
                && $imageFileType !="pptx") {
                    echo "Format du document non pris en charge.";
                    $uploadOk = 0;
                }
                                                    /**

*/
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    
                // if everything is ok, try to upload file
                }else{
                    move_uploaded_file($_FILES["imgToUpload"]["tmp_name"], $target_file);
                    setTofProfil($_POST['id'],$target_dir.$_FILES['imgToUpload']['name']);?>
                    <img src="<?php echo $target_dir.$_FILES['imgToUpload']['name']?>" class="photoProfilOn" height='75px' width='90px'><?php
                }
            }else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
            break;
        }
        case 'delImgProfil':{
            if (!empty($_POST)) {
                delTofProfil($_POST["id"]);
            }else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
            break;
        }
        case 'addComent':{
            if (isset($_POST["id"])) {
                $data=explode("#..#", $_POST["id"]);
                $id=$data[0];
                $com=$data[1];
                if ($com!="" && $com!="undefined") {
                    addComs($id,$_SESSION["cle"],$com);
                }
            }else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
            break;
        }
        case 'delComs':{
            if (isset($_POST["com"])) {
                $com=$_POST["com"];
                $check=verifIsMyCom($com,$_SESSION['cle']);
                if (!empty($check)) {
                    $id=$check[0][0];
                    delComs($id);
                }
            }else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
            break;
        }
        case 'alterComs':{
            if (isset($_POST["com"])) {
                $data=explode('#..#',$_POST["com"]);
                $id=$data[0];
                $newText=$data[1];
                $check=verifIsMyCom($text,$id,$_SESSION['cle']);
                if (!empty($check)) {
                    $id=$check[0][0];
                    alterComs($id,$_SESSION['cle'],$text,$newText);
                }
            }else{?>
                <script>
                    $("body").html('<center><img src="source/waitimg.gif"></center>');
                    $("body").load("index.php");
                </script><?php
            }
            break;
        }
        
								/**
																FIN SWITCH UC 
*/
	}?>
</body>