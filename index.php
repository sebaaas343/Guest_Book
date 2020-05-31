<?php

error_reporting(E_ALL);

include_once "GuestbookMessage.php";

//include_once "FileGuestbookRepository.php";
//$repository = new FileGuestbookRepository();

$page = isset($_GET["page"]) ? $_GET["page"] : 1;

include_once "DatabaseGuestbookRepository.php";
$repository = new DatabaseGuestbookRepository();

$messages = $repository->getAll($page);

$model = new GuestbookMessage();

if (isset($_POST) && (count($_POST) > 0)) {

    if (isset($_POST["username"])) $model->username = $_POST["username"];
    if (isset($_POST["message"])) $model->message = $_POST["message"];

    if ($model->validate()) {
        $repository->add($model);
    }

}

$all= $repository->get_count_messages();
$all_users = $repository->get_count_users();

?>

<html>

<head>

    <style>

        .message {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-line {
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<form method="post">

    <?php if ($model->hasErrors()): ?>
        <div>
            <?= $model->errorSummary(); ?>
        </div>
    <?php endif; ?>

    <div class="form-line">
        <input maxlength="25" type="text" name="username" placeholder="Ваше имя:" value="<?= $model->username ?>">
    </div>

    <div class="form-line">
        <textarea name="message" placeholder="Ваше сообщение"><?= $model->message; ?></textarea>
    </div>

    <input type="submit">

    <p>Всего <?=$all?> сообщений</p>
    <p>Всего <?=$all_users?> пользователей</p>
</form>

<?php if ($page > 1): ?>
    <a href="?page=<?= --$page; ?>">Предыдущая страница</a>
<?php endif; ?>

<?php if (count($messages) > 0) foreach ($messages as $message): ?>

    <div class="message">

        <p><?= $message->username; ?></p>
        <p><?= $message->message; ?></p>
        <p><?= date("d.m.Y H:i", $message->time); ?></p>

    </div>

<?php endforeach; ?>

<a href="?page=<?= ++$page; ?>">Следующая страница</a>

</body>

</html>