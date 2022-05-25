$(document).ready(function () {
  const baseURL = "http://localhost/utakmice/api";

  fetchTabele();
  function fetchTabele() {
    $.ajax({
      type: "GET",
      url: baseURL + "/fetch-tabela.php",
      success: function (response) {
        formirajTabelu(JSON.parse(response));
      },
    });
  }
  function formirajTabelu(ekipe) {
    ekipe.forEach((ekipa, index) => {
      $("#prikazTabele").append(
        `
        <tr>
        <td>${index + 1}</td>
        <td>${ekipa.naziv_ekipa}</td>
        <td>${ekipa.grad_ekipa}</td>
        <td>${ekipa.trener}</td>
        <td>${ekipa.bodovi}</td>
        </tr>
        `
      );
    });
  }
});
