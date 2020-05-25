<?php


class FileGuestbookRepository extends GuestbookRepository
{

    /**
     * @param GuestbookMessage $model
     *
     * @return bool
     */
    public function add($model)
    {

        $id = $this->getNextId();
        $filename = "messages/g-$id.txt";
        $f = fopen($filename, "w");
        fwrite($f, $model->toJson());
        fclose($f);

        return true;

    }

    /**
     * @return GuestbookMessage[]
     */
    public function getAll()
    {

        $messages = [];

        $files = glob("messages/*.txt");

        foreach ($files as $file) {

            $f = fopen($file, "r");
            $s = fread($f, filesize($file));
            fclose($f);

            $model = new GuestbookMessage();
            $model->fromJson($s);

            $messages[] = $model;

        }

        return $messages;

    }

}