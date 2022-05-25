<html>
<?php require('./head.php') ?>

<body>
    <?php require('./navbar.php') ?>

    <div class="container">
        <h3>Pregled svih utakmica:</h3>
        <table class="table table-info">
            <thead class="thead-dark">
                <tr>
                    <th>Datum</th>
                    <th>Domacin</th>
                    <th>Poeni domacin</th>
                    <th>Poeni gost</th>
                    <th>Gost</th>
                    <th>Brisanje utakmice</th>
                </tr>
            </thead>
            <tbody id="prikazUtakmica">

            </tbody>
        </table>
    </div>


    <?php require('./scripts.php') ?>
    <script src="./js/index.js"></script>
</body>

</html>