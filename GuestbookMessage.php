<?php

class GuestbookMessage
{

    public $username;
    public $message;
    public $time;

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

    private $errors = [];

    /**
     * @return bool
     */
    public function validate() {

        $hasErrors = false;
        $this->errors = [];

        if (!$this->username) {
            $hasErrors = true;
            $this->errors[] = "Не заполнено ваше имя";
        }

        if (!$this->message) {
            $hasErrors = true;
            $this->errors[] = "Не заполнено ваше сообщение";
        }

        return !$hasErrors;

    }

    /**
     * @return bool
     */
    public function hasErrors() {
        return count($this->errors) !== 0;
    }

    /**
     * @return string
     */
    public function errorSummary() {
        return implode(PHP_EOL, $this->errors);
    }

}