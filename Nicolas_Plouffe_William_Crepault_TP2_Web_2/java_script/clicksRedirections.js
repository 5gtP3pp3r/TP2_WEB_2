document.addEventListener('DOMContentLoaded', function () 
{
    let btnConnexion = document.getElementById('connexion');
    if (btnConnexion) {
        btnConnexion.addEventListener('click', function() 
        {
            window.location.href = 'pageAuth.php';
        });
    }

    let btnDeconnexion = document.getElementById('deconnexion');
    if (btnDeconnexion) 
    {
        btnDeconnexion.addEventListener('click', function() 
        {
            window.location.href = 'index.php';
        });
    }

    let ajoutUtilisateur = document.getElementById('ajoutUtilisateur');
    if (ajoutUtilisateur)
    {
        ajoutUtilisateur.addEventListener('click', function() 
        {
            window.location.href = 'pageAjoutUtilisateur.php';
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

    // Ajoutez les autres clicks de redirection ici
});