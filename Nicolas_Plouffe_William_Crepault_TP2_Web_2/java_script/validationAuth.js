"use strict";

// Ce fichier ne fait que confirmer le regex coté client, la confirmation via la BD sera faite ailleur

const regexNom = /^[A-Za-z]{2,}$/;
const regexPassword = /^[a-zA-Z\d]{6,}$/;
const EMPTY = "";

let nomUtilisateur = document.getElementById("nomUtilisateur");
let password = document.getElementById("password");

let listResult = document.getElementById("listResult");

let validList = EMPTY;
let errorList = EMPTY;

document.getElementById("submitUS0").addEventListener("click", validationAuth);
document.getElementById("resetUS0").addEventListener("click", resetForm);

function validationAuth(event){
    event.preventDefault();
    validList = EMPTY;
    errorList = EMPTY;
    listResult.classList.remove("red");
    let isValid = true;

    if (nomUtilisateur.value.trim() == EMPTY || !regexNom.test(nomUtilisateur.value)){
        errorList += "<li><p>Entrez un nom d'utilisateur valide</p></li>";
        isValid = false;
    }
    else
    {
        validList += "<li><p>Nom d'utilisateur valide</p></li>";
    }

    if (password.value.trim() == EMPTY || !regexPassword.test(password.value)){
        errorList += "<li><p>Entrez un mot de passe valide</p></li>";
        isValid = false;
    }
    else
    {
        validList += "<li><p>Mot de passe valide</p></li>";
    }


    if (!isValid){
        listResult.innerHTML = errorList;
        listResult.classList.add("red");
    }
    else{
        listResult.innerHTML = validList;
    }        
}

function resetForm(){
    listResult.innerHTML = EMPTY;
    nomArtiste.value = EMPTY;
    ville.value = VALUE_ZERO;
    photo.value = EMPTY;
    
}