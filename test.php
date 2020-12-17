 <?php
$mysqli = new mysqli("localhost", "root", "", "parking_db");
if($mysqli->connect_error) {
  exit('Could not connect');
}

		$nom_abonne=$_REQUEST['nom_abonne'];
        $prenom_abonne=$_REQUEST['prenom_abonne'];

        $date_naissance=$_REQUEST['date_naissance'];
      
       
        $telephone=$_REQUEST['telephone'];
  

$sql="SELECT * FROM `abonnes` WHERE `nom_abonne`='".$nom_abonne."' AND `prenom_abonne`='".$prenom_abonne."'' AND `date_naissance`='".$date_naissance."''' AND `telephone`='".$telephone."'";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($cid, $cname, $name, $adr, $city, $pcode, $country);
$stmt->fetch();
$stmt->close();

echo "<table>";
echo "<tr>";
echo "<th>CustomerID</th>";
echo "<td>" . $cid . "</td>";
echo "<th>CompanyName</th>";
echo "<td>" . $cname . "</td>";
echo "<th>ContactName</th>";
echo "<td>" . $name . "</td>";
echo "<th>Address</th>";
echo "<td>" . $adr . "</td>";
echo "<th>City</th>";
echo "<td>" . $city . "</td>";
echo "<th>PostalCode</th>";
echo "<td>" . $pcode . "</td>";
echo "<th>Country</th>";
echo "<td>" . $country . "</td>";
echo "</tr>";
echo "</table>";
?> 