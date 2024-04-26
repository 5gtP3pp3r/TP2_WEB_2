$(document).ready(function () {
  const regexNom = /^[a-zA-ZÀ-ÿ0-9]+$/;
  const regexCode = /^[A-Z]{3}\d{4}$/;
  const regexImage = /^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/i;

  const VALUE_ZERO = 0;
  const EMPTY = "";

  let validList = EMPTY;
  let errorList = EMPTY;

  $("#dateAjout").val(today);

  $("#submitUS2").click(function (event) {
    validList = EMPTY;
    errorList = EMPTY;
    $("#listResult").removeClass("red");
    let isValid = true;

    if (!regexNom.test($("#titre").val())) {
      errorList += "<li><p>Veuillez entrez un nom d'artiste valide</p></li>";
      isValid = false;
    }

    if (!regexCode.test($("#code").val())) {
      errorList += "<li><p>Veuillez entrer un code valide</p></li>";
      isValid = false;
    }

    if ($("#dateAjout").val() > today || $("#dateAjout").val() < today) {
      errorList += "<li><p>Veuillez entrer la date d'aujourd'hui</p></li>";
      isValid = false;
    } else if ($("#dateAjout").val() == EMPTY) {
      validList += "<li><p>Date d'ajout: " + today + "</p></li>";
    }

    if ($("#genreMusical").val() == VALUE_ZERO) {
      errorList += "<li><p>Veuillez entrer un genre valide</p></li>";
      isValid = false;
    }

    if (!regexImage.test($("#photo").val()) || $("#photo").val() == EMPTY) {
      errorList += "<li><p>Image manquante ou format d'image invalide</p></li>";
      isValid = false;
    }

    if (!isValid) {
      event.preventDefault();
      $("#listResult").html(errorList);
      $("#listResult").addClass("red");
    }
  });

  $("#resetUS2").click(function () {
    setTimeout(function () {
      $("#listResult").html(EMPTY);
      $("#titre").val(EMPTY);
      $("#code").val(EMPTY);
      $("#dateAjout").val(today);
      $("#genreMusical").val(VALUE_ZERO);
      $("#photo").val(EMPTY);
    }, 0);
  });
});
