<?php session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "system";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Ajouter</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="css/style.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="admin.css" >
</head>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 1000px;
  margin-left: 100px;
  text-align: center;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #372289;
  color: white;
}
</style>

<body>
  <div class="header">
	<?php include 'header_prof.php'; ?>
  </div>
  <p>modification de la table profisseur</p>

 
  <table id="customers">
	  <tr>
	    <th>ProfID</th>
	    <th>Password</th>
	    <th>Nom et Prenom</th>
	    <th>Numéro Telephone</th>
	    <th>Matiere</th>
	    <th>Modifier</th>
	  </tr>
	  
	  		<?php
	  			$sql="select * from profisseur ";
	  			$result = mysqli_query($conn,$sql);

	  			while($row = mysqli_fetch_assoc($result)){
	  		?>
	  		
	  		<tr>
	  		 <form method="post" action="modifier_P.php">
	  			<td><input type="hidden" name="id_" value="<?php echo $row['ProfID'] ?>"><?php echo $row['ProfID'] ?></input></td>
	  			<td><input type="hidden" name="pass" value="<?php echo $row['Password'] ?>"><?php echo $row['Password'] ?></input></td>
	  			<td><input type="hidden" name="N_P" value="<?php echo $row['Nom_Prenom'] ?>"><?php echo $row['Nom_Prenom'] ?></input></td>
	  			<td><input type="hidden" name="N_tele" value="<?php echo $row['N_Telephone'] ?>"><?php echo $row['N_Telephone'] ?></input></td>
	  			<td><input type="hidden" name="Mat" value="<?php echo $row['Matiere'] ?>"><?php echo $row['Matiere'] ?></input></td>
	  			<td><button class="bt">afficher</button></td>
	  		 </form>
	  		 </tr>
	  		
	  		<?php } 
	  		  if(isset($_POST['id_'])){
	  			$_SESSION['id']=$_POST['id_']; 
	  		  }
	  		?>
	  		<tr>
	  		 <form method="post" action="modifier_traitement.php" >
	  			<td><h3 class="input_border"><?php if(isset($_POST['id_'])){ echo $_POST['id_']; }?></h3></td>
	  			<td><input type="text" name="Password" placeholder="password" value="<?php if(isset($_POST['pass'])){ echo $_POST['pass']; }?>"required autocomplete="off"></input></td>
	  			<td><input type="text" name="Nom_Prenom" placeholder="Nom et Prenom" value="<?php if(isset($_POST['N_P'])){ echo $_POST['N_P']; } ?>"required autocomplete="off"></td>
	  			<td><input type="number" name="N_Telephone" placeholder="Numéro du telephone" value="<?php  if(isset($_POST['N_tele'])){ echo $_POST['N_tele']; }?>"required autocomplete="off"></input></td>
	  			<td><input type="text" name="Matiere" placeholder="Matiere" value="<?php if(isset($_POST['Mat'])){ echo $_POST['Mat'];}?>" required autocomplete="off"></input></td>
	  			<td><button class="bt">Modifier</button></td>
	  		 </form>
	  		</tr>
  </table>
		
		  <?php
				if(isset($_COOKIE['success'])) {

					echo "<div id='alert' class='alert alert-success' role='alert'>".$_COOKIE['success']."</div>";

				}else if(isset($_COOKIE['err'])){

					echo "<div class='alert alert-danger' role='alert'>".$_COOKIE['err']."</div>";
				}
		  ?>
		


</body>