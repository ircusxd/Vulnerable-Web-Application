<!DOCTYPE html>
<html>
<head>
	<title>SQL Injection</title>
	<link rel="shortcut icon" href="../Resources/hmbct.png" />
</head>
<body>

	 <div style="background-color:#c9c9c9;padding:15px;">
      <button type="button" name="homeButton" onclick="location.href='../homepage.html';">Home Page</button>
      <button type="button" name="mainButton" onclick="location.href='sqlmainpage.html';">Main Page</button>
	</div>

	<div align="center">
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" >
		<p>John -> Doe</p>
		First name : <input type="text" name="firstname">
		<input type="submit" name="submit" value="Submit">
	</form>
	</div>


<?php 
    // Variables de conexión
    $servername = "localhost";
    $username = "root";
    $password = $_ENV["SECRET"];
    $db = "1ccb8097d0e9ce9f154608be60224c7c";

    // Crear conexión
    $conn = mysqli_connect($servername, $username, $password, $db);

    // Verificar conexión
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Preparar la consulta para evitar inyección SQL
    if(isset($_POST["submit"])){
        $firstname = $_POST["firstname"];

        // Uso de consultas preparadas para evitar inyecciones SQL
        $stmt = $conn->prepare("SELECT lastname FROM users WHERE firstname = ?");
        $stmt->bind_param("s", $firstname);  // 's' indica que es un string
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se obtienen resultados
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["lastname"];
                echo "<br>";
            }
        } else {
            echo "0 results";
        }

        // Cerrar la declaración
        $stmt->close();
    }

    // Cerrar la conexión
    mysqli_close($conn);
?>
</body>
</html>
