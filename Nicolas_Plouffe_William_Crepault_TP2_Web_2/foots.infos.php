<footer>
    <div class="container-fluid">
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
    </div>
</footer>
<?php

    $pageScript = GetScripts($pageName);

    function GetScripts($pageName)
    {
        if ($pageName == 'pageAcceuil')
        {
            return '<script src="java_script/highlightBtn.js"></script>';
        }
        else if ($pageName == 'pageListeAlbums')
        {
            return '<script src="java_script/jsonList.js"></script>';
        }
        else if ($pageName == 'pageArtiste')
        {
            return '<script src="java_script/validationArtisteJS.js"></script>';
        }
        else if ($pageName == 'pageOeuvre')
        {
            return '<script src="java_script/date.js"></script>' . 
                   '<script src="java_script/validationOeuvre.js"></script>';
        }
        else if ($pageName == 'pageAlbum')
        {
            return '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>' .
                   '<script src="java_script/date.js"></script>' . 
                   '<script src="java_script/validationAlbumjQuery.js"></script>';
        }
    }   
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" 
crossorigin="anonymous"></script>
<?php
    echo $pageScript;
?>
</body>

</html>