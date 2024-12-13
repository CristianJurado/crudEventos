<?php
include 'procesar.php';

$errores = isset($_SESSION['errores']) ? $_SESSION['errores'] : [];
unset($_SESSION['errores']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Organizador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Añadir Organizador</h2>

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
    <input type="hidden" name="accion" value="guardarOrganizador">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del Organizador:</label>
        <input type="text" class="form-control" id="nombre" name="nombre" style="max-width: 50%;">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" style="max-width: 50%;">
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono" style="max-width: 50%;">
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<a href="index.php" class="btn btn-secondary mt-3 mb-5">Volver</a>

</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>
</html>