window.onload = function() {

    if (sessionStorage.scrollPosition) {
        window.scrollTo(0, parseInt(sessionStorage.getItem('scrollPosition')));
        sessionStorage.removeItem('scrollPosition'); 
    }
    window.addEventListener('beforeunload', function() {
        sessionStorage.setItem('scrollPosition', window.scrollY);
    });
}

/* Merci GPT pour cette fonction qui remety la page en place après un clique 
sur un oeuvre à ajouter ou à supprimer, la page revient à la position où le 
click a eu lieu pour ne pas trop perdre la position après un choix.*/