$(document).ready(function () {

    const regexNom = /^[a-zA-ZÀ-ÿ0-9]+$/;
    const regexCode = /^[A-Z]{3}\d{4}$/;
    const regexImage = /^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/i;

    const VALUE_ZERO = 0;
    const EMPTY = "";

    let validList = EMPTY;
    let errorList = EMPTY;

    $("#dateAjout").val(today);

    $("#submitUS2").click(function(event){
        event.preventDefault();

        validList = EMPTY;
        errorList = EMPTY;
        $("#listResult").removeClass("red");
        let isValid = true;

        if (!regexNom.test($("#titre").val())){
            errorList += "<li><p>Veuillez entrez un nom d'artiste valide</p></li>";  
            isValid = false;          
        } else{
            validList += "<li><p>Titre de l'album: " + $("#titre").val() + "</p></li>";            
        }
        if (!regexCode.test($("#code").val())){
            errorList += "<li><p>Veuillez entrer un code valide</p></li>";  
            isValid = false;          
        } else{
            validList += "<li><p>Code de l'album: " + $("#code").val() + "</p></li>";
        }
        if ($("#dateAjout").val() > today || $("#dateAjout").val() <today) {
            errorList += "<li><p>Veuillez entrer la date d'aujourd'hui</p></li>";
            isValid = false;
        } else if ($("#dateAjout").val() == EMPTY){
            validList += "<li><p>Date d'ajout: " + today + "</p></li>";            
        } else{
            validList += "<li><p>Date d'ajout: " + $("#dateAjout").val() + "</p></li>";
        }
        if ($("#genreMusical").val() == VALUE_ZERO){ 
            errorList += "<li><p>Veuillez entrer un genre valide</p></li>";
            isValid = false;
        } else{
            validList += "<li><p>Genre: " + $("#genreMusical option:selected").text() + "</p></li>";
        }
        if (!regexImage.test($("#photo").val()) || $("#photo").val() == EMPTY){
            errorList += "<li><p>Image manquante ou format d'image invalide</p></li>";
            isValid = false;
        } else{
            validList += "<li><p>Photo: " + $("#photo").val() + "</p></li>";
        }

        if (!isValid){
            $("#listResult").html(errorList);
            $("#listResult").addClass("red");
        } 
        else{
            $("#listResult").html(validList);
        }
    });

    $("#resetUS2").click(function(){
        setTimeout(function(){
            $("#listResult").html(EMPTY);
            $("#titre").val(EMPTY);
            $("#code").val(EMPTY);
            $("#dateAjout").val(today);
            $("#genreMusical").val(VALUE_ZERO);
            $("#photo").val(EMPTY);
            /* Même phénomène que pour le code
            de la page "Oeuvre".*/
        },0);
    });

});