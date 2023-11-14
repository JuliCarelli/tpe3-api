<?php
require_once "./app/helpers/db.helper.php";
class DirectoresModel
{
    private $db;
    private $table;
    private $campos;

    function __construct()
    {
        $this->db = DbHelper::connect_db();
        $this->table = "directores";
        $this->campos = ["id", "nombre"];
    }

    function getById($id)
    {
        $query = $this->db->prepare('SELECT * FROM ' . $this->table . ' WHERE id = ?');
        $query->execute([$id]);
        $data = $query->fetch(PDO::FETCH_OBJ);

        return $data;
    }

    public function getAll($order_by = 'id', $order = "")
    {

        $order_by = in_array($order_by, $this->campos, true) ? $order_by : $this->campos[0];
        $order = $order == "DESC" ? "DESC" : "ASC";

        $query = $this->db->prepare("SELECT * FROM $this->table ORDER BY $order_by $order");
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function insert($data)
    {
        try {
            $query = $this->db->prepare('INSERT INTO ' . $this->table . ' (nombre) values (?)');
            return $query->execute([$data->nombre]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    function updateById($id, $data)
    {
        $query = $this->db->prepare('UPDATE ' . $this->table . ' SET nombre = ? WHERE id = ?');
        return $query->execute([$data->nombre, $id]);
    }

    public function deleteById($id)
    {
        try {
            $query = $this->db->prepare('DELETE FROM ' . $this->table . ' WHERE id = ?');
            return $query->execute([$id]);
        } catch (\Throwable $th) {
            return false;
        }
    }
}
