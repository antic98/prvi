$(document).ready(function () {
  const baseURL = "http://localhost/utakmice/api";

  fetchTabele();
  function fetchTabele() {
    $.ajax({
      type: "GET",
      url: baseURL + "/fetch-utakmica.php",
      success: function (response) {
        formirajTabelu(JSON.parse(response));
      },
    });
  }
  function formirajTabelu(utakmice) {
    $("#prikazUtakmica").html("");
    utakmice.forEach((utakmica) => {
      const domacinPoeni = utakmica.broj_poena_domacin;
      const gostPoeni = utakmica.broj_poena_gost;

      $("#prikazUtakmica").append(
        `
          <tr>
          <td>${utakmica.datum}</td>
          <td>${utakmica.naziv_ekipa_domacin}</td>
          <td>${
            domacinPoeni > gostPoeni
              ? `<b>${domacinPoeni}</b>`
              : `${domacinPoeni}`
          }</td>
          <td>${
            domacinPoeni < gostPoeni ? `<b>${gostPoeni}</b>` : `${gostPoeni}`
          }</td>
          <td>${utakmica.naziv_ekipa_gost}</td>
          <td align="center"> 
          <button id="${utakmica.id_utakmica}"
           class="btn btn-danger brisanjeUtakmice">X</button>
          </td>
          </tr>
          `
      );
    });
  }
  $("body").on("click", ".brisanjeUtakmice", function (e) {
    $.ajax({
      type: "POST",
      url: baseURL + "/delete-utakmica.php",
      data: {
        id_utakmica: $(this).attr("id"),
      },
      dataType: "json",
      success: function (response) {
        alert(response);
        fetchTabele();
      },
      error: function (response) {
        alert(response.responseText);
        fetchTabele();
      },
    });
  });
});
