<?php

class GuestbookMessage
{

    public $time;
    public $username;
    public $message;

    /**
     * GuestbookMessage constructor.
     *
     * @param string $username
     * @param string $message
     */
    public function __construct($username = "", $message = "")
    {

        $this->username = $username;
        $this->message = $message;
        $this->time = time();

    }

    /**
     * @return string
     */
    public function toJson()
    {

        return json_encode([
            "username" => $this->username,
            "message" => $this->message,
        ]);

    }

    /**
     * @param $string
     */
    public function fromJson($string) {

        $a = json_decode($string, true);
        $this->message = $a["message"];
        $this->username = $a["username"];

    }

}