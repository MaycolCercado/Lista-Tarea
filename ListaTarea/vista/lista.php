<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Proyectos - CRUD</title>
    <link rel="stylesheet" href="Estilo/Style.css">
</head>
<body>
    <div class="container">
        <h2>📋 Lista de Proyectos</h2>
        
        <div class="action-buttons">
            <a href="index.php?action=nuevo" class="btn btn-primary">+ Nuevo Proyecto</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($lista) && is_array($lista) && count($lista) > 0): ?>
                    <?php foreach ($lista as $list): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($list['proyecto']); ?></strong></td>
                            <td><?php echo htmlspecialchars($list['descripcion']); ?></td>
                            <td>
                                <div class="table-actions">
                                    <a href="index.php?action=editar&id=<?php echo (int)$list['id']; ?>" class="edit-link">✏️ Editar</a>
                                    <a href="javascript:void(0);" onclick="eliminarProyecto(<?php echo (int)$list['id']; ?>)" class="delete-link">🗑️ Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="empty-message">📭 No hay proyectos para mostrar. ¡Crea uno nuevo!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="Ajax/ajax.js"></script>
</body>
</html>