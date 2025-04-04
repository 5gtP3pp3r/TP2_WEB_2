<footer class="mt-auto fixed-bottom">
    <div class="container-fluid align-items-center">
        <div class="row align-items-center">
            <div class="col-3 d-flex justify-content-center">
                <a href="#top"><img src="Images/retour_haut.png" alt="Retour vers le haut"></a>
            </div>
            <div class="col-6 text-center">
                <p><b>Will&Nic</b> - Une filliale de Gammick International -Copyright © 2024-</p>
                <?php date_default_timezone_set('Etc/GMT+4');?>
                <p><b><?=date("Y-m-d H:i")?></b></p>
                <p>Ce projet utilise: &nbsp;<img src="Images/outils.png" alt="outlis"></p>
            </div>
            <div class="col-3 d-flex justify-content-center">
                <img src="Images/cd1.png" alt="Image de cd" class="img-fluid">
            </div>
        </div>
    </div>
</footer>
<?php

    $pageScript = GetScripts($pageNom);

    function GetScripts($pageNom)
    {
        switch ($pageNom)
        {
            case 'pageUtilisateur':
                return '<script src="java_script/validationUtilisateur.js"></script>';
            case 'pageAcceuil':
                return '<script src="java_script/highlightBtn.js"></script>';
            case 'pageListeAlbums':
                return '<script src="java_script/jsonList.js"></script>';
            case 'pageArtiste':
                return '<script src="java_script/validationArtisteJS.js"></script>';
            case 'pageOeuvre':
                return '<script src="java_script/date.js"></script>' . 
                       '<script src="java_script/validationOeuvre.js"></script>';
            case 'pageAlbum':
                return '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>' .
                       '<script src="java_script/date.js"></script>' . 
                       '<script src="java_script/validationAlbumjQuery.js"></script>';
            case 'pageAchat':
                return '<script src="java_script/ancrePage.js"></script>';
            case 'pagePanier':
                return '<script src="java_script/ancrePage.js"></script>';
        }        
    }   
?>
<script src="java_script/clicksRedirections.js"></script>
<?= $pageScript ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
crossorigin="anonymous"></script>
</body>

</html>