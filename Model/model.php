<?php
class Model
{
    function conn()
    {
        $database = 'purple';
        $user = 'root';
        $password = '';
        $bd = "mysql:host=localhost;dbname=" . $database . ";charset=utf8";
        return new PDO($bd, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    function create($tableName, $tableData)
    {
        $colunas = "";
        $valores = "";
        foreach ($tableData as $key => $value) {
            $colunas .= "$key, ";
            $valores .= ":$key, ";
        }

        $tableName = trim($tableName);
        $colunas = trim($colunas, ', ');
        $valores = trim($valores, ', ');

        $sqler = ("INSERT INTO $tableName ($colunas) VALUES ($valores)");

        $conn = $this->conn();
        $conn->prepare($sqler)->execute($tableData);
    }

    function select($tableName, $where){
        $conn = $this->conn();
        $sql = "select * from " . $tableName . " " . $where;

        $data = array();
        foreach ($conn->query($sql) as $row) {
            array_push($data, $row);
        }
        return $data;

    }
    
}
