<?php
include 'procesar.php';
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] :'';
$orden = isset($_GET['orden']) ? $_GET['orden'] : 'nombre_evento';
$direccion= isset($_GET['direccion']) ? $_GET['direccion'] : 'asc';
$eventos =listarEventos($conn, $filtro, $orden, $direccion,$limite=10,$offset=0);
$limite=3;
$total=mysqli_num_rows($eventos);
$paginaEstamos=isset($_GET['pagina']) ? $_GET['pagina'] :1;
$pagina=ceil($total/$limite);
$offset=($paginaEstamos-1)*$limite;
$eventos =listarEventos($conn, $filtro, $orden, $direccion,$limite,$offset);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Eventos Deportivos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
<form method="GET">
    <input type="text" id="filtro" name="filtro" placeholder="Buscar" value="<?php echo $filtro ?>">
    <button class="btn btn-primary">Buscar</button>
</form>
<!-- EVENTOS DEPORTIVOS -->

<h2>Listado de Eventos</h2>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th><?php echo generarEnlace('nombre_evento', $orden, $direccion, $filtro, 'Nombre');?></th>
            <th><?php echo generarEnlace('tipo_deporte', $orden, $direccion, $filtro, 'Deporte');?></th>
            <th><?php echo generarEnlace('fecha', $orden, $direccion, $filtro, 'Fecha');?></th>
            <th><?php echo generarEnlace('hora', $orden, $direccion, $filtro, 'Hora');?></th>
            <th><?php echo generarEnlace('ubicacion', $orden, $direccion, $filtro, 'Ubicacion');?></th>
            <th><?php echo generarEnlace('organizador', $orden, $direccion, $filtro, 'Organizador');?></th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
    while ($evento = $eventos->fetch_assoc()) {
        echo "<tr>
                <td>{$evento['nombre_evento']}</td>
                <td>{$evento['tipo_deporte']}</td>
                <td>{$evento['fecha']}</td>
                <td>{$evento['hora']}</td>
                <td>{$evento['ubicacion']}</td>
                <td>{$evento['organizador']}</td>
                <td>
                    <a href='formularioEvento.php?id={$evento['id']}' class='btn btn-warning btn-sm'>Editar</a>
                    <form action='procesar.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='accion' value='eliminarEvento'>
                        <input type='hidden' name='id' value='{$evento['id']}'>
                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este evento?\");'>Eliminar</button>
                    </form>
                </td>
            </tr>";
    }
    ?>
    </tbody>
</table>
<a href="formularioEvento.php" class="btn btn-primary">Añadir Evento</a> <br><br>
<?php echo cambiarPaginaAnterior($limite,$offset+=$limite,$paginaEstamos-1); ?>
<a  class="btn btn-primary" href="index.php">1</a>
<?php
    for($i=2; $i <= $pagina;$i++) {
        //echo"<a href='index.php' class='btn btn-primary me-1'>{$i}</a>";
        echo cambiarPagina($limite,$offset+=$limite,$i);
    }
?>
<?php echo cambiarPaginaSiguiente($limite,$offset+=$limite,$paginaEstamos+1,$pagina); ?>

<!-- ORGANIZADORES -->

<h2 class="mt-5">Listado de Organizadores</h2>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $organizadores = listarOrganizadores($conn);
    while ($organizador = $organizadores->fetch_assoc()) {
        echo "<tr>
                <td>{$organizador['nombre']}</td>
                <td>{$organizador['email']}</td>
                <td>{$organizador['telefono']}</td>
                <td>
                    <form action='procesar.php' method='POST' style='display:inline;'>
                        <input type='hidden' name='accion' value='eliminarOrganizador'>
                        <input type='hidden' name='id' value='{$organizador['id']}'>
                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este organizador?\");'>Eliminar</button>
                    </form>
                </td>
            </tr>";
    }
    ?>
    </tbody>
</table>
<a href="formularioOrganizador.php" class="btn btn-primary">Añadir Organizador</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>