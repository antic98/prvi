<html>
<?php require('./head.php') ?>

<body>
    <?php require('./navbar.php') ?>

    <div class="container">
        <h3>Timovi:</h3>
        <table class="table table-info">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Ekipa</th>
                    <th>Grad</th>
                    <th>Trener</th>
                    <th>Bodovi</th>
                </tr>
            </thead>
            <tbody id="prikazTabele">

            </tbody>
        </table>
    </div>

    <?php require('./scripts.php') ?>
    <script src="./js/tabela.js"></script>
</body>

</html>