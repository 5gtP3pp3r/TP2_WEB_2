<?php
include 'connexionBD.php';

header('Content-Type: application/json');

$conn = connexionBD();

$albums = [];

$query = "SELECT albums.*, oeuvres.titre_oeuvre FROM albums
          LEFT JOIN oeuvres ON albums.id = oeuvres.id_album";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];

    if (!isset($albums[$id])) {
        $albums[$id] = [
            'titre' => $row['titre'],
            'pht_couvt' => $row['pht_couvt'],
            'titre_oeuvre' => []
        ];
    }
    if ($row['titre_oeuvre']) {
        $albums[$id]['titre_oeuvre'][] = $row['titre_oeuvre'];
    }
}

$albums = array_values($albums);

echo json_encode(['albums' => $albums]);

/* Je ne voulais pas refaire l'affichage des albums au complet.
J'ai cherché sur le net si je pouvais convertir les données de
la bd en json pour réutiliser mon script "jsonList.js.*/
