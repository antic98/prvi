<?php
require('../db/baza.php');
require('../klase/Ekipa.php');

$ekipa = new Ekipa($conn);

echo json_encode($ekipa->fetch_sve_ekipe());
