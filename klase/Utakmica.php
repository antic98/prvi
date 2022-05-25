<?php

class Utakmica
{

    private $conn;
    private $table_name = "utakmica";

    public $id_utakmica;

    public $id_domacin;
    public $broj_poena_domacin;

    public $id_gost;
    public $broj_poena_gost;

    public function __construct($conn, $id_domacin = 0, $broj_poena_domacin = 0, $id_gost = 0, $broj_poena_gost = 0)
    {
        $this->conn = $conn;
        $this->id_domacin = $id_domacin;
        $this->id_gost = $id_gost;
        $this->broj_poena_domacin = $broj_poena_domacin;
        $this->broj_poena_gost = $broj_poena_gost;
        if ($id_domacin != 0 && $broj_poena_domacin != 0)
            $this->zabelezi_utakmicu();
    }


    public function fetch_po_id()
    {
        $sql = "SELECT * FROM " . $this->table_name . " WHERE id_utakmica = " . $this->id_utakmica;

        if ($result = $this->conn->query($sql)) {
            $utakmica = $result->fetch_assoc();
            $this->id_domacin = $utakmica['id_domacin'];
            $this->broj_poena_domacin = $utakmica['broj_poena_domacin'];
            $this->id_gost = $utakmica['id_gost'];
            $this->broj_poena_gost = $utakmica['broj_poena_gost'];
        }
    }
    public function fetch_sve_utakmice()
    {
        $sql = "SELECT 
        e1.naziv_ekipa AS naziv_ekipa_domacin,
        e2.naziv_ekipa AS naziv_ekipa_gost,
        u.*
         FROM " . $this->table_name . " u 
        JOIN ekipa e1 ON e1.id_ekipa=u.id_domacin 
        JOIN ekipa e2 ON e2.id_ekipa=u.id_gost
        ORDER BY datum
        ";
        $utakmice = [];
        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                array_push($utakmice, $row);
            }
        }
        return $utakmice;
    }
    private function zabelezi_utakmicu()
    {

        $sql = "INSERT INTO " . $this->table_name . " ( id_gost, id_domacin, broj_poena_gost, broj_poena_domacin ) VALUES ($this->id_gost, $this->id_domacin,$this->broj_poena_gost,$this->broj_poena_domacin)";

        $this->conn->query($sql);
        $this->id_ekipa = $this->conn->insert_id;
    }
    public function get_pobednik_id()
    {
        $this->fetch_po_id();

        // Domacin pobednik
        if ($this->broj_poena_domacin > $this->broj_poena_gost) {
            return $this->id_domacin;
        }
        // Gost pobednik
        else if ($this->broj_poena_domacin < $this->broj_poena_gost) {
            return $this->id_gost;
        }
        // Nereseno (nema nereseno al sto da ne)
        else {
            return 0;
        }
    }

    public function delete_po_id()
    {
        $sql = "DELETE FROM " . $this->table_name . " WHERE id_utakmica = " . $this->id_utakmica;

        if ($this->conn->query($sql)) {
            return true;
        }
        return false;
    }
}
