"use strict";

function getAlbums(){
    fetch("album_list/albums.json") 
    .then(response => response.json())
    .then(json => {
        const albumList = json.albums;
        const jasonFile = document.getElementById("jasonFile"); 

        for (const album of albumList){
            let albumPlaceholder = document.createElement("div");

            albumPlaceholder.className = "col-12 col-sm-6 col-md-4 col-lg-3";                
            let albumTitle = document.createElement("h4");
            albumTitle.textContent = "Album: " + album.titre; 
            albumPlaceholder.appendChild(albumTitle);

            let albumLink = document.createElement("a");
            albumLink.href = "https://www.google.com/search?q=" + album.titre + " album infos"; //   ;)
                            
            let albumImg = document.createElement("img");
            albumImg.src = "images/" + album.pht_couvt;
            albumImg.alt = "Couverture de l'album : " + album.titre;
            albumImg.className = "img-fluid rounded mx-auto d-block";

            albumLink.appendChild(albumImg);
            albumPlaceholder.appendChild(albumLink);
                
            let songsList = document.createElement("ul"); 
            songsList.className = "albumList";             
                                
            if (album.titre_oeuvre.length > 0){
                for (const song of album.titre_oeuvre){ 
                    let listItem = document.createElement("li");
                    listItem.textContent = song; 
                    songsList.appendChild(listItem); 
                }
                albumPlaceholder.appendChild(songsList); 
            }
            jasonFile.appendChild(albumPlaceholder);
        }
    })
}

document.addEventListener("DOMContentLoaded", getAlbums);