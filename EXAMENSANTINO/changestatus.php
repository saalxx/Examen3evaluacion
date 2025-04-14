<?
require_once "autoloader.php";
if($_SERVER["REQUEST_METHOD"] == 'GET'){
    $model = new Lighting();
    $model->changeStatus($_GET['id']);
    header("Location: index.php");
}
exit;
?>