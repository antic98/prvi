<html>
<?php require('./head.php') ?>

<body>
    <?php require('./navbar.php') ?>

    <div class="container">


        <div class="d-flex bordered">
            <div class="col">
                Izaberite domacu ekipu ili popunite formu za dodavanje nove ekipe
                <select class="form-control" id="selectPostojeceEkipeDomacin">
                    <option value="default">Izaberite ekipu:</option>
                </select>
            </div>
            <div class="col">
                Izaberite gostujucu ekipu ili popunite formu za dodavanje nove ekipe
                <select class="form-control" id="selectPostojeceEkipeGost">
                    <option value="default">Izaberite ekipu:</option>
                </select>
            </div>
        </div>
        <br>
        <form id="noveEkipe" class="bordered">
            <div class="d-flex">
                <div class="col">
                    <label for="naziv_ekipa_domacin"> Naziv domace ekipe:</label>
                    <input class="form-control" id="naziv_ekipa_domacin" type="text">
                    <label for="grad_ekipa_domacin"> Grad iz koje je ekipa:</label>
                    <input class="form-control" id="grad_ekipa_domacin" type="text">
                    <label for="trener_domacin"> Trener:</label>
                    <input class="form-control" id="trener_domacin" type="text">
                    <label for="broj_poena_domacin"> Broj poena koje je ostvarila:</label>
                    <input class="form-control" id="broj_poena_domacin" type="number" min="0">
                </div>
                <div class="col">
                    <label for="naziv_ekipa_gost"> Naziv gostujuce ekipe:</label>
                    <input class="form-control" id="naziv_ekipa_gost" type="text">
                    <label for="grad_ekipa_gost"> Grad iz koje je ekipa:</label>
                    <input class="form-control" id="grad_ekipa_gost" type="text">
                    <label for="trener_gost"> Trener:</label>
                    <input class="form-control" id="trener_gost" type="text">
                    <label for="broj_poena_gost"> Broj poena koje je ostvarila:</label>
                    <input class="form-control" id="broj_poena_gost" type="number" min="0">
                </div>
            </div>
            <br>
            <div class="d-flex">
                <input class="form-control btn btn-success" type="submit">
            </div>
        </form>
    </div>


    <?php require('./scripts.php') ?>
    <script src="./js/create-utakmica.js"></script>
</body>

</html>