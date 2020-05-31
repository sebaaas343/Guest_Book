<?php

include_once "GuestbookMessage.php";
include_once "GuestbookRepository.php";
include_once "DatabaseGuestBookRepository.php";

$repository = new DatabaseGuestBookRepository();
$k=1;
for ($i = 0; $i++< 50;) {

    for ($j = 0; $j++< 10;) {
        $model = new GuestbookMessage();
        $model->username = "user #$i";
        $model->message = "message #$k";
        $k++;
        $repository->add($model);
    }


}