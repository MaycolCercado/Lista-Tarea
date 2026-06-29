<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <form id="formulario" method="POST">
        <div>
            <label for="num1">Número 1:</label>
            <input type="number" id="num1" name="num1" placeholder="Ingrese numero 1" required>
        </div>
        <br>
        <div>
            <label for="operacion">Operación:</label>
            <input type="text" id="operacion" name="operacion" placeholder="Ingrese operación (+ o -)" required>
        </div>
        <br>
        <div>
            <label for="num2">Número 2:</label>
            <input type="number" id="num2" name="num2" placeholder="Ingrese numero 2" required>
        </div>
        <br>
        <div>
            <input type="submit" id="procesar" value="Calcular">
        </div>
    </form>

    <?php 
    class classCalculadora {
        public function Sumar($num1, $num2){
            return $num1 + $num2;
        }
        public function Restar($num1, $num2){
            return $num1 - $num2;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $num1 = isset($_POST['num1']) ? $_POST['num1'] : 0;
        $num2 = isset($_POST['num2']) ? $_POST['num2'] : 0;
        $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : '';

        $calculadora = new classCalculadora();

        echo "<hr><h3>Resultado: ";
        
        if ($operacion == '+') {
            echo $calculadora->Sumar($num1, $num2);
        } elseif ($operacion == '-') {
            echo $calculadora->Restar($num1, $num2);
        } else {
            echo "Operación no válida. Intente con + o -";
        }
        
        echo "</h3>";
    }
    ?>
</body>
</html>