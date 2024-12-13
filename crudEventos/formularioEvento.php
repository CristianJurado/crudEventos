<?php
include 'procesar.php';

$evento = null;
if (isset($_GET['id'])) {
    $evento = obtenerEvento($conn, $_GET['id']);
}

$errores = isset($_SESSION['errores']) ? $_SESSION['errores'] : [];
unset($_SESSION['errores']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $evento ? 'Editar Evento' : 'Añadir Evento'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2><?php echo $evento ? 'Editar Evento' : 'Añadir Evento'; ?></h2>

<?php if (!empty($errores)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="procesar.php" method="POST">
    <input type="hidden" name="accion" value="guardarEvento">
    <input type="hidden" name="id" value="<?php echo $evento['id'] ?? ''; ?>">

    <div class="mb-3">
        <label for="nombre_evento" class="form-label">Nombre del Evento:</label>
        <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" value="<?php echo $evento['nombre_evento'] ?? ''; ?>" style="max-width: 50%;">
    </div>

    <div class="mb-3">
        <label for="tipo_deporte" class="form-label">Tipo de Deporte:</label>
        <input type="text" class="form-control" id="tipo_deporte" name="tipo_deporte" value="<?php echo $evento['tipo_deporte'] ?? ''; ?>" style="max-width: 50%;">
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha:</label>
        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $evento['fecha'] ?? ''; ?>" style="max-width: 50%;">
    </div>

    <div class="mb-3">
        <label for="hora" class="form-label">Hora:</label>
        <input type="time" class="form-control" id="hora" name="hora" value="<?php echo $evento['hora'] ?? ''; ?>" style="max-width: 50%;">
    </div>

    <div class="mb-3">
        <label for="ubicacion" class="form-label">Ubicación:</label>
        <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?php echo $evento['ubicacion'] ?? ''; ?>" style="max-width: 50%;">
    </div>

    <div class="mb-3">
        <label for="id_organizador" class="form-label">Organizador:</label>
        <select name="id_organizador" class="form-select" id="id_organizador" style="max-width: 50%;">
            <option value="">Selecciona un organizador</option>
            <?php
            $organizadores = listarOrganizadores($conn);
            while ($organizador = $organizadores->fetch_assoc()) {
                $selected = ($evento && $evento['id_organizador'] == $organizador['id']) ? 'selected' : '';
                echo "<option value='{$organizador['id']}' $selected>{$organizador['nombre']}</option>";
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary"><?php echo $evento ? 'Actualizar' : 'Guardar'; ?> Evento</button>
</form>

<a href="index.php" class="btn btn-secondary mt-3 mb-5">Volver</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>