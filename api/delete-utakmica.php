<?php

require('../db/baza.php');
require('../klase/Utakmica.php');
require('../klase/Ekipa.php');

$id_utakmica = $_POST['id_utakmica'];

$utakmica = new Utakmica($conn);

$utakmica->id_utakmica = $id_utakmica;




$pobednik = $utakmica->get_pobednik_id();

if (!$utakmica->delete_po_id())
    die("Greska prilikom brisanja utakmice!");

if ($pobednik) {
    $pobednicka_ekipa = new Ekipa($conn);
    $pobednicka_ekipa->id_ekipa = $pobednik;
    if (!$pobednicka_ekipa->smanji_bodove(3))
        die("Doslo je do greske prilikom brisanja");
} else {
    $domacin = new Ekipa($conn);
    $gost = new Ekipa($conn);
    $domacin->id_ekipa = $utakmica->id_domacin;
    $gost->id_ekipa = $utakmica->id_gost;
    if (!$gost->smanji_bodove(1) || !$domacin->smanji_bodove(1))
        die("Doslo je do greske prilikom brisanja");
}
echo "Uspesno obrisana utakmica.";
