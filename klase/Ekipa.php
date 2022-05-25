<?php

class Ekipa
{

    private $conn;
    private $table_name = "ekipa";

    public $id_ekipa;
    public $naziv_ekipa;
    public $bodovi;
    public $grad_ekipa;
    public $trener;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function fetch_sve_ekipe()
    {
        $ekipe = [];
        $sql = "SELECT * FROM " . $this->table_name . " ORDER BY bodovi DESC";


        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($ekipe, $row);
            }
        }
        return $ekipe;
    }

    public function fetch_po_id()
    {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE id_ekipa = " . $this->id_ekipa;

        $ekipa = $this->conn->query($sql)->fetch_assoc();

        return $ekipa;
    }

    public function create_ekipa()
    {

        $sql = "INSERT INTO " . $this->table_name . " (naziv_ekipa, grad_ekipa, trener)
        VALUES ('" . $this->naziv_ekipa . "', '" . $this->grad_ekipa . "', '" . $this->trener . "' )";


        if ($this->conn->query($sql) === TRUE) {
            $this->id_ekipa = $this->conn->insert_id;
            return true;
        }

        return false;
    }


    public function postoji()
    {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE naziv_ekipa = '" . $this->naziv_ekipa . "'";

        if ($result = $this->conn->query($sql)) {

            $ekipa = $result->fetch_assoc();
            if ($ekipa) {
                $this->id_ekipa = $ekipa['id_ekipa'];
                return true;
            }
            return false;
        }
        return false;
    }
    public function povecaj_bodove($broj_bodova)
    {
        $sql = "UPDATE " . $this->table_name . " SET bodovi = bodovi + " . $broj_bodova . "  WHERE id_ekipa = " . $this->id_ekipa;
        if ($this->conn->query($sql)) {
            return true;
        }
        return false;
    }
    public function smanji_bodove($broj_bodova)
    {
        $sql = "UPDATE " . $this->table_name . " SET bodovi = bodovi - " . $broj_bodova . "  WHERE id_ekipa = " . $this->id_ekipa;
        if ($this->conn->query($sql)) {

            return true;
        }
        return false;
    }
}
