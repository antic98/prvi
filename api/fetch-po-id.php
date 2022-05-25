<?php

require('../db/baza.php');
require('../klase/Ekipa.php');


$id_ekipa = $_GET['id_ekipa'];

$ekipa = new Ekipa($conn);

$ekipa->id_ekipa = $id_ekipa;

echo json_encode($ekipa->fetch_po_id());
