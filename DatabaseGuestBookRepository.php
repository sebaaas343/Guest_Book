<?php

include_once "GuestbookRepository.php";
class DatabaseGuestBookRepository extends GuestbookRepository
{

    /**
     * @return false|mysqli
     *
     * @throws Exception
     */
    private function connect()
    {

        $connect = mysqli_connect("localhost", "mysql", "mysql");

        if ($connect == false) {
            $error = mysqli_connect_error();
            throw new Exception("База данных недоступна. $error.");
        }

        mysqli_select_db($connect, "gb");

        return $connect;

    }

    const limit = 10;
    const messages_table_name = "messages";

    /**
     * @param GuestbookMessage $message
     * @return bool
     * @throws Exception
     */
    public function add($message)
    {

        $connect = $this->connect();

        $attributes = [
            $message->username,
            $message->message,
            $message->time,
        ];

        $attributes = array_map(function ($item) {
            return "\"$item\"";
        }, $attributes);

        $query = "INSERT INTO " . self::messages_table_name . " (username, text, time) VALUES (" . implode(",", $attributes) . ")";

        $result = mysqli_query($connect, $query);
        if ($result == false) {
            $error = mysqli_error($connect);
            throw new Exception("Некорректный запрос. $error.");
        }

        return true;

    }

    /**
     * @param int $page
     *
     * @return GuestbookMessage[]
     *
     * @throws Exception
     */
    public function getAll($page)
    {

        $offset = ($page - 1) * self::limit;

        $connect = $this->connect();
        $query = "SELECT * FROM " . self::messages_table_name . " ORDER BY id DESC LIMIT " . self::limit . " OFFSET $offset";

        $result = mysqli_query($connect, $query);
        if ($result == false) {
            $error = mysqli_error($connect);
            throw new Exception("Некорректный запрос. $error.");
        }

        $array = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $messages = [];
        foreach ($array as $item) {

            $message = new GuestbookMessage();
            $message->username = $item["username"];
            $message->message = $item["text"];
            $message->time = $item["time"];

            $messages[] = $message;
        }

        return $messages;
    }


    /**public function get_all_count()
    {

        $connect = $this->connect();

        $query = "SELECT COUNT(*) FROM " . self::messages_table_name;

        $result = mysqli_query($connect, $query);

        if ($result == false) {
            $error = mysqli_error($connect);
            throw new Exception("Некорректный запрос. $error.");
        }


        //$array1 = mysqli_fetch_all($result, MYSQLI_ASSOC);
       //var_dump($array1);
       //foreach ($array1 as $item)
       //{
        //   var_dump($item);
       ///}
        return $l;
    }**/

    /**
     * @return int
     * @throws Exception
     */
    public function get_count_messages()
    {

        $connect = $this->connect();

        $query = "SELECT * FROM " . self::messages_table_name;

        $result = mysqli_query($connect, $query);

        if ($result == false) {
            $error = mysqli_error($connect);
            throw new Exception("Некорректный запрос. $error.");
        }

        //$count = mysqli_fetch_row($result)[0];    ?
        //$count = count($array);
        $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $count = 0;
        foreach ($array as $item)

        if(!empty($item["text"])) {$count++;}

        return $count;
    }

    public function get_count_users()
    {

        $connect = $this->connect();
        //$query = "SELECT COUNT(*) AS пользователи, username FROM " . self::messages_table_name . "messages GROUP BY username";
        $query = "SELECT * FROM " . self::messages_table_name;
        $result = mysqli_query($connect, $query);

        if ($result == false) {
            $error = mysqli_error($connect);
            throw new Exception("Некорректный запрос. $error.");
        }

        $array = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $m = array_column($array, 'username');
            $users = array_unique($m);
            $count_unique_users = count($users);

        return $count_unique_users;
    }

}


