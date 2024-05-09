"use strict";
document.addEventListener('DOMContentLoaded', function () 
{
    let btnConnexion = document.getElementById('connexion');
    if (btnConnexion) {
        btnConnexion.addEventListener('click', function() 
        {
            window.location.href = 'pageAuth.php';
        });
    }

    let ajoutUtilisateur = document.getElementById('ajoutUtilisateur');
    if (ajoutUtilisateur)
    {
        ajoutUtilisateur.addEventListener('click', function() 
        {
            window.location.href = 'pageUtilisateur.php';
        });
    }

    let btnPanier = document.getElementById('panier');
    if (btnPanier)
    {
        btnPanier.addEventListener('click', function() 
        {
            window.location.href = 'pagePanier.php';
        });
    }

    let enregistrer = document.getElementById('enregistrer');
    if(enregistrer)
    {
        enregistrer.addEventListener('click', function() 
        {
            window.location.href = 'pageUtilisateur.php';
        });
    }

    let retourAchat = document.getElementById('retourAchat');
    if(retourAchat)
    {
        retourAchat.addEventListener('click', function() 
        {
            window.location.href = 'pageAchat.php';
        });
    }
});