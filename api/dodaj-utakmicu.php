<?php

require('../db/baza.php');
require('../klase/Ekipa.php');
require('../klase/Utakmica.php');

$domacin = new Ekipa($conn);
$gost = new Ekipa($conn);

$domacin->naziv_ekipa = $_POST['naziv_ekipa_domacin'];
$gost->naziv_ekipa = $_POST['naziv_ekipa_gost'];


if (!$domacin->postoji()) {
    $domacin->grad_ekipa = $_POST['grad_ekipa_domacin'];
    $domacin->trener = $_POST['trener_domacin'];
    if ($domacin->grad_ekipa === "" || $domacin->trener === "")
        die("Nisu dobro uneti parametri, za ovu ekipu morate da naglasite grad i trenera.");
    $domacin->create_ekipa();
}
if (!$gost->postoji()) {
    $gost->grad_ekipa = $_POST['grad_ekipa_gost'];
    $gost->trener = $_POST['trener_gost'];
    if ($gost->grad_ekipa === "" || $gost->trener === "")
        die("Nisu dobro uneti parametri, za ovu ekipu morate da naglasite grad i trenera.");
    $gost->create_ekipa();
}

if ($domacin->id_ekipa === $gost->id_ekipa)
    die("Gost i domacin su ista ekipa! Nije dozvoljeno!");

$broj_poena_domacin =  $_POST['broj_poena_domacin'];
$broj_poena_gost =  $_POST['broj_poena_gost'];

$utakmica = new Utakmica($conn, $domacin->id_ekipa, $broj_poena_domacin, $gost->id_ekipa, $broj_poena_gost);
$pobednik = $utakmica->get_pobednik_id();
if ($pobednik === $domacin->id_ekipa) {
    $domacin->povecaj_bodove(3);
    echo "Dodata utakmica uspesno, domacin je pobedio!";
} else if ($pobednik === $gost->id_ekipa) {
    $gost->povecaj_bodove(3);
    echo "Dodata utakmica uspesno, gost je pobedio!";
    // U kosarci nema nereseno, ali dobra je fora.
} else {
    $gost->povecaj_bodove(1);
    $domacin->povecaj_bodove(1);
    echo "Dodata utakmica uspesno, neresen rezultat!";
}
