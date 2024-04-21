<?php
include 'connexionBD.php'; 

header('Content-Type: application/json');

$conn = connexionBD();  

$albums = [];

$query = "SELECT albums.*, oeuvres.titre_oeuvre, genres.descGenre FROM albums
          LEFT JOIN oeuvres ON albums.id = oeuvres.id_album
          INNER JOIN genres ON albums.id_genre = genres.id";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];

    if (!isset($albums[$id])) {
        $albums[$id] = [
            'id_album' => $row['id'],
            'titre' => $row['titre'],
            'code_album' => $row['code_album'],
            'description' => $row['descGenre'],
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