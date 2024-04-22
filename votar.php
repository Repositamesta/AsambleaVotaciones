<?php
// Aquí se debería incluir el archivo de conexión a la base de datos
require_once 'database.php';
$conexion = Database::obtenerConexion();
// Obtener el ID del usuario
$id = $_GET['id'];
// Obtener el ID de la propuesta y el ID de la asamblea seleccionada
$idpropuesta = $_POST['idpropuesta'];
$idasamblea = $_POST['idasamblea'];

// Realizar una consulta JOIN para obtener los datos de la propuesta, la asamblea y los votos
$query = "SELECT * FROM propuestas, votaciones WHERE propuestas.idpropuesta = votaciones.idpropuesta and idasamblea = '$idasamblea' and idvotante = '$id'";

$resultado = $conexion->query($query);

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    ?>
    <script>
        // JavaScript para mostrar el mensaje de error en una ventana emergente
        alert("Usted ya votó en la asamblea actual");
        // Redireccionamiento a la página anterior
        window.history.back();
    </script>
    <?php
} else {
    $sql = "INSERT INTO votaciones (idpropuesta, idvotante) VALUES ('$idpropuesta', '$id')";
    if ($conexion->query($sql) === TRUE) {
        ?>
        <script>
            // JavaScript para mostrar el mensaje de éxito en una ventana emergente
            alert("Votación registrada correctamente");
            // Redireccionamiento a la página anterior
            window.history.back();
        </script>
        <?php
    }
}
?>