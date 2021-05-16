<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = '24hstore';
$connection = mysqli_connect($host, $username, $password, $database);
mysqli_set_charset($connection, 'UTF8');
// if(!$connection){
//     die("Failed".mysqli_connect_error());
// }
class DB
{
    public function __construct()
    {
        global $connection;
        $this->connection = $connection;
        if ($this->connection->connect_error) {
            echo "Fail" . $this->connec_error;
        }
        // echo "connect success";
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    protected function closeConnection()
    {
        if ($this->connection != null) {
            $this->connection->close();
            $this->connection = null;
        }
    }
}
$db = new DB();
