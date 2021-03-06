<?php

class DBController {
    // Database Connection Properties
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $database = 'mobileshopee';

    // COnnection property
    public $con = null;

    public function __construct()
    {
        $this->con = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        if($this->con->connect_error) {
            echo 'Connection Fail due to ' .$this->con->connect_error;
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    public function closeConnection() {
        if($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }

}
