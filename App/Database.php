<?php


class Database{
    private string $servername = 'localhost';
    private string $username = 'root';
    private string $passwd = '';
    private string $dbname = 'parfume.art';
    protected object $conn;

    protected string $table = '';
    protected string $primaryKey = '';

    public function __construct($table,$primaryKey){
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        try {
            $this->conn = new mysqli($this->servername,$this->username,$this->passwd,$this->dbname);
        } catch (Exception $e) {
            die("Ops something went wrong...");
        }
    }

    
}