$(document).ready(function () {
  const baseURL = "http://localhost/utakmice/api";
  let ekipe = Array();
  $.ajax({
    type: "GET",
    url: baseURL + "/fetch-tabela.php",
    success: function (response) {
      ekipe = JSON.parse(response);
      ekipe.forEach((ekipa) => {
        $("#selectPostojeceEkipeDomacin").append(
          `
                <option value="${ekipa.id_ekipa}" >${ekipa.naziv_ekipa}</option>
            `
        );
        $("#selectPostojeceEkipeGost").append(
          `
                <option value="${ekipa.id_ekipa}" >${ekipa.naziv_ekipa}</option>
            `
        );
      });
    },
  });

  $("#selectPostojeceEkipeDomacin").change(function (e) {
    e.preventDefault();
    $.ajax({
      type: "GET",
      url: baseURL + "/fetch-po-id.php",
      data: {
        id_ekipa: $("#selectPostojeceEkipeDomacin").val(),
      },
      dataType: "json",
      success: function (ekipa) {
        $("#naziv_ekipa_domacin").val(ekipa.naziv_ekipa);
        $("#grad_ekipa_domacin").val(ekipa.grad_ekipa);
        $("#trener_domacin").val(ekipa.trener);
      },
    });
  });
  $("#selectPostojeceEkipeGost").change(function (e) {
    e.preventDefault();
    $.ajax({
      type: "GET",
      url: baseURL + "/fetch-po-id.php",
      data: {
        id_ekipa: $("#selectPostojeceEkipeGost").val(),
      },
      dataType: "json",
      success: function (ekipa) {
        $("#naziv_ekipa_gost").val(ekipa.naziv_ekipa);
        $("#grad_ekipa_gost").val(ekipa.grad_ekipa);
        $("#trener_gost").val(ekipa.trener);
      },
    });
  });

  $("#noveEkipe").submit(function (e) {
    e.preventDefault();
    // Inputi za domacina
    let naziv_ekipa_domacin = $("#naziv_ekipa_domacin").val();
    let grad_ekipa_domacin = $("#grad_ekipa_domacin").val();
    let trener_domacin = $("#trener_domacin").val();
    let broj_poena_domacin = $("#broj_poena_domacin").val();

    // Inputi za gosta
    let naziv_ekipa_gost = $("#naziv_ekipa_gost").val();
    let grad_ekipa_gost = $("#grad_ekipa_gost").val();
    let trener_gost = $("#trener_gost").val();
    let broj_poena_gost = $("#broj_poena_gost").val();

    if (
      validacija(
        naziv_ekipa_domacin,
        grad_ekipa_domacin,
        trener_domacin,
        broj_poena_domacin,
        naziv_ekipa_gost,
        grad_ekipa_gost,
        trener_gost,
        broj_poena_gost
      )
    )
      dodajUtakmicu(
        naziv_ekipa_domacin,
        grad_ekipa_domacin,
        trener_domacin,
        broj_poena_domacin,
        naziv_ekipa_gost,
        grad_ekipa_gost,
        trener_gost,
        broj_poena_gost
      );
  });

  // Ajax
  function dodajUtakmicu(
    naziv_ekipa_domacin,
    grad_ekipa_domacin,
    trener_domacin,
    broj_poena_domacin,
    naziv_ekipa_gost,
    grad_ekipa_gost,
    trener_gost,
    broj_poena_gost
  ) {
    $.ajax({
      type: "POST",
      url: baseURL + "/dodaj-utakmicu.php",
      data: {
        naziv_ekipa_domacin,
        grad_ekipa_domacin,
        trener_domacin,
        broj_poena_domacin,
        naziv_ekipa_gost,
        grad_ekipa_gost,
        trener_gost,
        broj_poena_gost,
      },
      dataType: "json",
      success: function (response) {
        alert(response);
      },
      error: function (response) {
        alert(response.responseText);
      },
    });
  }

  function validacija(
    naziv_ekipa_domacin,
    grad_ekipa_domacin,
    trener_domacin,
    broj_poena_domacin,
    naziv_ekipa_gost,
    grad_ekipa_gost,
    trener_gost,
    broj_poena_gost
  ) {
    if (
      naziv_ekipa_domacin == "" ||
      grad_ekipa_domacin == "" ||
      trener_domacin == "" ||
      broj_poena_domacin == "" ||
      naziv_ekipa_gost == "" ||
      grad_ekipa_gost == "" ||
      trener_gost == "" ||
      broj_poena_gost == ""
    ) {
      alert("Sva polja moraju biti popunjena!");
      return false;
    }
    return true;
  }
});
