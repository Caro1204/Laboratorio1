<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deudas</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="contenedor">
        <h1>Registro de Pagos de Deudas</h1>

        <?php
            require_once 'db.php';
        
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $deudor = $_POST['deudor'];
                $cuota = $_POST['cuota'];
                $cuota_capital = $_POST['cuota_capital'];
                $fecha_pago = $_POST['fecha_pago'];

                addPago($deudor, $cuota, $cuota_capital, $fecha_pago);

                header('Location: index.php');
                exit();
            }
            

            $pagos = getPagos();
        ?>

        <div>
            <h2>Nuevo Pago</h2>
            <form action="index.php" method="post">
                <div>
                    <label for="deudor">Deudor</label>
                    <input type="text" name="deudor" id="deudor" required>
                </div>
                <div>
                    <label for="cuota">Cuota</label>
                    <input type="number" name="cuota" id="cuota" required>
                </div>
                <div>
                    <label for="cuota_capital">Cuota Capital</label>
                    <input type="number" step="0.01" name="cuota_capital" id="cuota_capital" required>
                </div>
                <div>
                    <label for="fecha_pago">Fecha de Pago</label>
                    <input type="date" name="fecha_pago" id="fecha_pago" required>
                </div>
                <button type="submit">Agregar Pago</button>
            </form>
        </div>

        <div>
            <h2>Lista de Pagos</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Deudor</th>
                        <th>Cuota</th>
                        <th>Cuota Capital</th>
                        <th>Fecha de Pago</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagos as $pago): ?>
                    <tr>
                        <td><?= ($pago->id) ?></td>
                        <td><?= ($pago->deudor) ?></td>
                        <td><?= ($pago->cuota) ?></td>
                        <td><?= ($pago->cuota_capital) ?></td>
                        <td><?= ($pago->fecha_pago) ?></td>
                        <td>
                         <!-- Formulario para eliminar -->
                <form action="index.php" method="post">
                    <input type="hidden" name="eliminar_id" value="<?= htmlspecialchars($pago->id) ?>">
                    <button type="submit" class="boton boton-eliminar" onclick="return confirm('¿Estás seguro que deseas eliminar este pago?')">Eliminar</button>
                </form>
                    </td>
                    </tr>
                    
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>