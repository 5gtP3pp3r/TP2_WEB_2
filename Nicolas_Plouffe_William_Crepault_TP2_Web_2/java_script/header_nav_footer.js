"use strict";

const headerContent = 
`<div class="container-fluid">
  <div class="row">  
    <div class="col-4 col-sm-4 col-md-2 d-flex justify-content-center">          
      <img src="Images/headset_cartoon_gauche.png" alt="Bonhomme ecouteurs" class="img-fluid"> 
    </div>                          
    <div class="col-4 col-sm-4 col-md-8 text-center">
      <h1><b>My Music Online</b></h1>          
      </div>         
    <div class="col-4 col-sm-4 col-md-2 d-flex justify-content-center">
      <img src="Images/headset_cartoon_droit.png" alt="Bonhomme ecouteurs" class="img-fluid"> 
    </div> 
    <div class="col-12 d-flex justify-content-center">
      <img src="Images/portee_notes.png" alt="Portee de notes img-fluid">
    </div>
  </div>       
</div>`;

const navContent = 
`<div class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">           
      <a class="navbar-brand" href="pageAccueil.html"><b><h1>Menu principal</h1></b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link active" aria-current="page" href="pageListeAlbums.html">&nbsp;&nbsp;&nbsp;Liste des albums disponibles</a></li>
          <li class="nav-item"><a class="nav-link" href="pageArtiste.html">&nbsp;&nbsp;&nbsp;Ajouter un nouvel artiste</a></li>
          <li class="nav-item"><a class="nav-link" href="pageOeuvre.html">&nbsp;&nbsp;&nbsp;Ajouter une nouvelle oeuvre</a></li>
          <li class="nav-item"><a class="nav-link" href="pageAlbum.html">&nbsp;&nbsp;&nbsp;Ajouter un nouvel album</a></li>
          <li class="nav-item"><a class="nav-link disabled" aria-disabled="true"></a></li>
        </ul>
      </div>
    </div>
</div>`;

const footerContent = 
`<div class="container-fluid">   
    <div class="row align-items-center">       
      <div class="col-3 d-flex justify-content-center">
        <a href="#top"><img src="Images/retour_haut.png" alt="Retour vers le haut"></a>              
      </div>   
      <div class="col-6 text-center">
        <p><b>Will&Nic</b> -Une filliale de Gammick International -Copyright © 2024-</p>
      </div>
      <div class="col-3 d-flex justify-content-center">
      <img src="Images/cd1.png" alt="Image de cd" class="img-fluid">
      </div>
    </div>
  </div>`;

function insertSiteComponents() 
{
    document.getElementById("headerPlaceholder").innerHTML = headerContent;
    document.getElementById("navPlaceholder").innerHTML = navContent;
    document.getElementById("footerPlaceholder").innerHTML = footerContent;
}

document.addEventListener('DOMContentLoaded', insertSiteComponents);
