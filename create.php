<?php 
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include 'functions.php';
$pdo = pdo_connect_mysql();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$msg = '';
// Proverka if POST data  !empty
if (!empty($_POST)) {
    // $_Post data !empty insert new record
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
   $name = isset($_POST['name']) ? $_POST['name'] : '';
    $adress = isset($_POST['adress']) ? $_POST['adress'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $gas = isset($_POST['gas']) ? $_POST['gas'] : '';
    $water = isset($_POST['water']) ? $_POST['water'] : '';
    $electro = isset($_POST['electro']) ? $_POST['electro'] : '';
    $sum = isset($_POST['sum']) ? $_POST['sum'] : '';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO `contacts`(`id`, `name`, `adress`, `phone`, `gas`, `water`, `electro`,`sum`)  VALUES (?,?,?,?,?,?,?,?)');
    $stmt->execute([$id, $name, $adress, $phone, $gas, $water, $electro,$sum]);
    // sucessed
    header('Location:/read.php');
}
?>
<?=template_header('Создание')?>

<div class="content update">
    <h2>Создание контакта!</h2>
    <form action="create.php" method="post">
        <label for="name">ФИО</label>
        <input type="text" name="name" placeholder="ФИО" id="name">
        <label for="adress">Адрес</label>
        <input type="text" name="adress" placeholder="" id="adress">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" placeholder="89xxxxxxxxx" id="phone">
        <label for="gas">Газ</label>
        <input type="text" name="gas" placeholder="" id="gas">
        <label for="water">Вода</label>
        
        <input type="text" name="water" value="" id="water">
         <label for="electro">Электричество</label>
        <input type="text" name="electro" placeholder="" id="electro">
        <input type="submit" value="Создать">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>