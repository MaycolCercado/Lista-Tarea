<?php
require_once "modelo/lista.php";

class listaControlador{
    private $lista;
    public function __construct(){
        $this->lista = new lista();
    }
    
    public function manejar(){
        $action = $_GET['action'] ?? ($_POST['action'] ?? 'listar');
        
        switch($action){
            case 'listar':
                $lista = $this->lista->verTodo();
                require_once "vista/lista.php";
                break;

            case 'listar_ajax':
                $this->responderJSON($this->lista->verTodo());
                break;
                
            case 'eliminar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // AJAX
                    $id = $_POST['id'] ?? null;
                    if (!empty($id)) {
                        $resultado = $this->lista->eliminar($id);
                        $this->responderJSON([], $resultado);
                    } else {
                        $this->responderJSON([], false, "ID no proporcionado");
                    }
                } else {
                    // GET tradicional
                    if (!empty($_GET['id'])){
                        $this->lista->eliminar($_GET['id']);
                    }
                    header("Location: index.php");
                }
                break;

            case 'editar':
                if (!empty($_GET['id'])){
                    $lista = $this->lista->obtenerPorId($_GET['id']);
                    require_once "vista/formulario.php";
                }
                break;

            case 'obtener':
                if (!empty($_POST['id'])) {
                    $proyecto = $this->lista->obtenerPorId($_POST['id']);
                    $this->responderJSON($proyecto, !empty($proyecto));
                } else {
                    $this->responderJSON([], false, "ID no proporcionado");
                }
                break;

            case 'actualizar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // AJAX
                    $id = $_POST['id'] ?? null;
                    $proyecto = $_POST['proyecto'] ?? null;
                    $descripcion = $_POST['descripcion'] ?? null;
                    
                    if (!empty($id) && !empty($proyecto) && !empty($descripcion)) {
                        $resultado = $this->lista->actualizar($id, $proyecto, $descripcion);
                        $this->responderJSON([], $resultado);
                    } else {
                        $this->responderJSON([], false, "Faltan datos");
                    }
                } else {
                    // GET tradicional
                    if (!empty($_POST['proyecto']) && !empty($_POST['descripcion']) && !empty($_GET['id'])){
                        $this->lista->actualizar($_GET['id'], $_POST['proyecto'], $_POST['descripcion']);
                    }
                    header("Location: index.php");
                }
                break;

            case 'nuevo':
                require_once "vista/formulario.php";
                break;

            case 'crear':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // AJAX
                    $proyecto = $_POST['proyecto'] ?? null;
                    $descripcion = $_POST['descripcion'] ?? null;
                    
                    if (!empty($proyecto) && !empty($descripcion)) {
                        $resultado = $this->lista->agregar($proyecto, $descripcion);
                        $this->responderJSON([], $resultado);
                    } else {
                        $this->responderJSON([], false, "Faltan datos");
                    }
                } else {
                    // GET tradicional
                    if (!empty($_POST['proyecto']) && !empty($_POST['descripcion'])){
                        $this->lista->agregar($_POST['proyecto'], $_POST['descripcion']);
                    }
                    header("Location: index.php");
                }
                break;

            default:
                $lista = $this->lista->verTodo();
                require_once "vista/lista.php";
        }
    }

    // Responder con JSON
    private function responderJSON($data, $ok = true, $error = null) {
        header('Content-Type: application/json; charset=utf-8');
        $response = [
            'ok' => $ok,
            'data' => $data
        ];
        if ($error) {
            $response['error'] = $error;
        }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>