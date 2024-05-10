$(document).ready(function () {
  const regexNom = /^[a-z0-9à-öø-ÿ]+(?:[ \-_.]*[a-z0-9à-öø-ÿ]+)*$/i;
  const regexCode = /^[A-Z]{3}\d{4}$/;
  const regexImage = /^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/i;

  const VALUE_ZERO = 0;
  const EMPTY = "";

  let errorList = EMPTY;

  $("#dateAjout").val(today);

  $("#submitUS2").click(function (event) {
    errorList = "<li>\"affichage via js avec un preventDefault si valeurs incorrectes\"</li>";
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

    if ($("#dateAjout").val() == EMPTY || $("#dateAjout").val() > today || $("#dateAjout").val() < today) {
      errorList += "<li><p>Veuillez entrer la date d'aujourd'hui</p></li>";
      isValid = false;
    }

    if ($("#genreMusical").val() == VALUE_ZERO) {
      errorList += "<li><p>Veuillez entrer un genre valide</p></li>";
      isValid = false;
    }

    if ($("#photo").val() != EMPTY && !regexImage.test($("#photo").val())) {
      errorList += "<li><p>Format d'image invalide, utilisez des fichiers .jpg .jpeg .png .gif .bmp</p></li>";
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
