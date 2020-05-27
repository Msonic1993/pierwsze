<html>
<head>
<title> "Wyniki dla towjego zapytania" </title>
</head>

<body>

<h1> Oto rezultaty wyszukiwania: </h1>

<?php
// utowrzenie krotkich nazw zmiennych
$metoda_szukania=$_POST['metoda_szukania'];
$wyrazenie=$_POST['wyrazenie'];

$wyrazenie = ($wyrazenie);

if (!$metoda_szukania || !$wyrazenie) {
	echo 'Brak parametrów wyszukiwania. Wróć do poprzedniej strony i spróbuj ponownie. ';
	exit;
}
echo ($wyrazenie);

if (!get_magic_quotes_gpc()) {
	$metoda_szukania = addcslashes($metoda_szukania);
	$wyrazenie = addcslashes($wyrazenie);
}
$servername = "s27.hekko.net.pl";
$username = "sancrow_znanylekarz";
$password = "1Ketiow1";
$base = "sancrow_znanylekarz";

// Create connection
@ $db = new mysqli($servername, $username, $password, $base);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
echo "Connected successfully";



$zapytanie = "SELECT * FROM `lekarze` WHERE `firstname` like '$wyrazenie'";
$wynik = $db->query($zapytanie);

$ile_znalezionych = $wynik->num_rows;

echo "<p> Ilość znalezionych pozycju: ".$ile_znalezionych."</p>";

for ($i=0; $i <$ile_znalezionych; $i++) {
	$wiersz = $wynik->fetch_assoc();
	echo "<p><strong>".($i+1).". Imię: ";
	echo stripcslashes($wiersz['firstname']);
	echo "</strong><br /> Nazwisko: ";
	echo stripcslashes($wiersz['lastname']);
	echo "</strong><br /> specjalizacja: ";
	echo stripcslashes($wiersz['specialist']);
	echo "</p>";
}
$wynik->free();
$db->close();

?>


</body>
</html>