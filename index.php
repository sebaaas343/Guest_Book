<?php

include_once "DatabaseGuestBookRepository.php";
include_once "GuestbookMessage.php";
include_once "GuestbookRepository.php";



$repository = new FileGuestbookRepository();

$messages = $repository->getAll();

//if (isset($_POST)) {

    // validate data

 //   $repository->add(new GuestbookMessage($_POST["username"], $_POST["message"]));

//}

?>

<html lang="RU">

<head>
    <meta charset="UTF-8">
    <title> Guestbook </title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div class="head">
<h1>Гостевая книга</h1>
</div>

<div class="form">
    <h2> Добавьте отзыв</h2>

    <form method="post">
        <div>
            <input type="text" name="username" placeholder="имя пользователя">
            <p></p>
            <input type="text" name="massage" placeholder="Оставьте сообщение">


        </div>
        <p></p>
        <div>
            <input type="submit" value="Добавить">
        </div>
    </form>

</div>
<div class="panel">
<h3>Отзывы:</h3>
    <?php foreach ($messages as $massage){
        echo $massage["username"] . "-" .$massage["message"];
    }  ?>

</div>

</body>

</html>