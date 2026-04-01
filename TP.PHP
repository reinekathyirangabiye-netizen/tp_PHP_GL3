<?php

$host = "localhost";
$user = "root";
$password ="";
$db = "carte_identite";

$conn = new mysql($host,$user,$password,$db);
if($conn->connect-error){
    die("erreur connection :".$conn->connect-error);
}

<!doctype html>
<html>
<head>
<title>carte_identite</title>
<style>

.card{width:800px;paddind:20px;border:1px solid black;}
.photo{width:120px;heigt:140px;border:1px solid black;}
.empreinte{width:120px;height:140px;border:1px solid black;}
</style>
</head>
<body>

<form action ="save.php" method="POST"enctype="multipart/form-data">
Numero_MIFP:<input type="text" name="numero_MIFP"required><br>
Nom:<input type="text" name="nom"><br>
Prenom:<input type="text" name="prenom"><br>
Nom du Pere:<input type="text" name="nom_pere"><br>
Nom du Mere:<input type="text" name="nom_mere"><br>
Province:<input type="text" name="province"><br>
Commune:<input type="text" name="commune"><br>
Colline:<input type="text" name="colline"><br>
Date naissance:<input type="text" name="date_naissance"><br>
Etat civil:<input type="text" name="etat_civil"><br>
profession:<input type="text" name="proffession"><br>
Lieu conception:<input type="text" name="lieu_conception"><br>
Autorite:<input type="text" name ="autorite"><br>
Date recu:input type="date" name="date_recu"><br>
Photo:<input type="file" name="photo"><br>
Empreinte:<input type="file" name="empreinte"><br>
button type="submit">Enregistrer</button>
</form>
</body>
</html>

include 'connexion.php';

$numero_MIFP =$_POST['numero_MIFP'];
$nom = $_POST ['nom'];
$prenom = $_POST ['prenom'];
$nom_pere = $_POST ['nom_pere'];
$nom_mere = $_POST ['nom_mere'];
$province = $_POST ['province'];
$commune = $_POST ['commune'];
$colline =$_POST ['colline'];
$date_naissance =$_POST['date_naissance'];
$etat_civil =$_POST['etat_civil'];
$profession =$_POST['profession'];
$lieu_conception =$_POST['lieu_conception'];
$autorite =$_POST['autorite'];
$date_recu =$_POST['date_recu'];
$photo =$_FILES['photo'] ['name'];
$temp_photo =$_FILES['photo'] ['temp_name'];
move_uploaded_file($temp_photo"uploads/".$empreinte);

$sql = "INSERT INTO Citoyens(numero_MIFP,nom,prenom,nom_pere,nom_mere,province,commune,colline,date_naisance,etat_civil,profession,lieu_conception,autorite,date_recu,photo,empreinte)
VALUES('$numero_MIFP','$nom','$prenom','$nom_pere','$nom_mere','$province','$commune','$colline','$daate_naissance','$etat_civil','$proffession','lieu_coneption','$autorite','$date_recu','$photo','$empreinte')"; 

if($conn->query($sql) ===TRUE){
    echo"enregistre avec succes";
}else{
    echo"erreur:".$conn->error;
}

$id =$_GET['id'];
$result =$conn->query("SELECT*FROM Citoyens WHERE id=$id");
$row = $result->fetch_assoc();

?>

<div class = "card">
<h2>CARTE D'IDENTITE NATIONALE</h2>
numero_MIFP:<?php echo $row['numero_MIFP'];?><br>
nom:<?php echo $row['nom'];?><br>
prenom:<?php echo $row['prenom'];?><br>
Nom pere:<?php echo $row['nom_pere'];?><br>
Nom mere:<?php echo $row['nom_mere'];?><br>
province:<?php echo $row['province'];?><br>
commune:<?php echo $row['commune'];?><br>
colline:<?php echo $row['colline'];?><br>
<img src="uploads/<?php echo $row['photo'];?>"class="photo">
<img src="uploads/<?php echo $row['emreinte'];?>"class="empreinte">

</div>









































































  
