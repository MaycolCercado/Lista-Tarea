<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($lista) ? 'Editar Proyecto' : 'Nuevo Proyecto'; ?> - CRUD</title>
    <link rel="stylesheet" href="Estilo/Style.css">
</head>
<body>
    <div class="container">
        <h2 id="formulario-titulo"><?php echo isset($lista) ? '✏️ Editar Proyecto' : '➕ Nuevo Proyecto'; ?></h2>
        
        <div class="form-container">
            <form id="formulario" method="POST">
                <div class="form-group">
                    <label for="proyecto">📌 Nombre del Proyecto:</label>
                    <input type="text" id="proyecto" name="proyecto" value="<?php echo isset($lista) ? htmlspecialchars($lista['proyecto']) : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">📝 Descripción:</label>
                    <textarea id="descripcion" name="descripcion" required><?php echo isset($lista) ? htmlspecialchars($lista['descripcion']) : ''; ?></textarea>
                </div>

                <div class="button-group">
                    <?php if (isset($lista)): ?>
                        <button type="button" id="formulario-boton" onclick="actualizarProyecto(<?php echo (int)$lista['id']; ?>)" class="btn btn-success">✅ Actualizar Proyecto</button>
                    <?php else: ?>
                        <button type="button" id="formulario-boton" onclick="crearProyecto()" class="btn btn-success">✅ Crear Proyecto</button>
                    <?php endif; ?>
                    <a href="index.php" class="btn btn-secondary">← Volver</a>
                </div>
            </form>
        </div>
    </div>
    <script src="Ajax/ajax.js"></script>
</body>
</html>