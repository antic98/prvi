<?php
require('../db/baza.php');
require('../klase/Utakmica.php');

$utakmica = new Utakmica($conn);

echo json_encode($utakmica->fetch_sve_utakmice());
