<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Checkcontact ID exists
if (isset($_GET['id'])) {
    // Select the record
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Контакт с таким ID не найден!');
    }
    
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" to delete record
            $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            header('Location:/read.php');
        } else {
            // User clicked the "No" button to !delete
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('Неверный ID!');
}
?>
<?=template_header('Удаление')?>

<div class="content delete">
    <h2>Удалить контакт #<?=$contact['id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
    <p>Вы хотите удалить контакт #<?=$contact['id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$contact['id']?>&confirm=yes">Да</a>
        <a href="delete.php?id=<?=$contact['id']?>&confirm=no">Нет</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>