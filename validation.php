<?php
class valdation
{
    public $email;
    public $password;

    public function __construct($email,$password)
    {
        $this->email=$email;
        $this->password=$password;
    }

    public function email($email)
    {
        if (!filter_var($email,FILTER_VALIDATE_EMAIL))

            return true;

        else
            return false;
    }

    public function password($password)
    {
        if (!preg_match("/^[a-zA-Z-0-9]*$/",$password))

            return true;

        else
            return false;
    }

}
?>