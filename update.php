<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include 'functions.php';
$pdo = pdo_connect_mysql();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$msg = '';
// Check if the contact id exists
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        //similarthe create.php instead  update
        $name = isset($_POST['name']) ? $_POST['name'] : '';
    $adress = isset($_POST['adress']) ? $_POST['adress'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $gas = isset($_POST['gas']) ? $_POST['gas'] : '';
    $water = isset($_POST['water']) ? $_POST['water'] : '';
    $electro = isset($_POST['electro']) ? $_POST['electro'] : '';
    $sum = isset($_POST['sum']) ? $_POST['sum'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE contacts SET name = ?, adress = ?, phone = ?, gas = ?, water = ?, electro=? WHERE id = ?');
        $stmt->execute([$name, $adress, $phone, $gas, $water,$electro, $_GET['id']]);
        header('Location:/read.php');
    }
    // Get  contact from  table
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Контакт не найден!');
    }
} else {
    exit('Контакт не найден!');
}
?>
<?=template_header('Редактирование')?>

<div class="content update">
    <h2>Обновление записи #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="name">ФИО</label>
        <input type="text" name="name" placeholder="John Doe" value="<?=$contact['name']?>" id="name">
        <label for="email">Адрес</label>
        <input type="text" name="adress" placeholder="" value="<?=$contact['adress']?>" id="adress">
        <label for="phone">Телефон</label>
        <input type="text" name="phone" placeholder="" value="<?=$contact['phone']?>" id="phone">
        <label for="title">Газ</label>
        <input type="text" name="gas" placeholder="" value="<?=$contact['gas']?>" id="gas">
        <label for="created">Вода</label>
        <input type="text" name="water" value="<?=$contact['water']?>" id="water">
         <label for="created">Элетр-во</label>
        <input type="text" name="electro" value="<?=$contact['electro']?>" id="electro">
        <input type="submit" value="Обновить">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>