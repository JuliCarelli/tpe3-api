<?php
require_once "./app/helpers/db.helper.php";

class PeliculasModel
{
    private $db;
    private $table;
    private $campos;

    public function __construct()
    {
        $this->db = DbHelper::connect_db();
        $this->table = "peliculas";
        $this->campos = ["id", "titulo", "genero", "year", "director"];
    }

    public function getById($id)
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

    function getAllByDirectorId($id)
    {
        $query = $this->db->prepare('SELECT * FROM ' . $this->table . ' WHERE director = ?');
        $query->execute([$id]);
        $data = $query->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

    public function insert($data)
    {

        try {
            $query = $this->db->prepare('INSERT INTO ' . $this->table . ' (titulo, genero, year, director) values (?,?,?,?)');
            return $query->execute([$data->titulo, $data->genero, $data->year, $data->director]);
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateById($id, $data)
    {
        $query = $this->db->prepare('UPDATE ' . $this->table . ' SET titulo = ?, genero = ?, year = ?, director = ? WHERE id = ?');
        return $query->execute([$data->titulo, $data->genero, $data->year, $data->director, $id]);
    }

    public function deleteById($id)
    {
        $query = $this->db->prepare('DELETE FROM ' . $this->table . ' WHERE id = ?');
        return $query->execute([$id]);
    }
    public function deleteAllByDirectorId($id)
    {
        $query = $this->db->prepare('DELETE FROM ' . $this->table . ' WHERE director = ?');
        return $query->execute([$id]);
    }
}
