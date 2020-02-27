<?php
require("crud.php");


// ############################## Tests unitaires ####################

// Recharger la base de données pour être sûr à 100% des données de test
require ".const.php";
$cmd = "mysql -u $user -p$pass < Restore-MCU-PO-Final.sql";
exec($cmd);


echo "Test unitaire de la fonction getAllItems : ";
$items = getAllFilmMakers();
if (count($items) == 4) {
    echo 'OK !!!';
} else {
    echo 'BUG !!!';
}
echo "\n";

echo "Test unitaire de la fonction getItem : ";
$item = getFilmMaker(1);
if ($item['firstname'] == 'Jean-Michel') {
    echo 'OK !!!';
} else {
    echo 'BUG !!!';
}
echo "\n";

echo "Test unitaire de la fonction getFilmMakerName : ";
$item = getFilmMakerByName('Bertrand');
if ($item['id'] == 1) {
    echo 'OK !!!';
} else {
    echo '### BUG ###';
}
echo "\n";

echo "Test unitaire de la fonction updateFilmMaker : ";
$item = getFilmMakerByName('chamblon');
$id = $item['id']; // se souvenir de l'id pour comparer
$item['firstname'] = 'Gérard';
$item['lastname'] = 'Menfain';
updateFilmMaker($item);
$readback = getFilmMaker($id);
if (($readback['firstname'] == 'Gérard') && ($readback['lastname'] == 'Menfain')) {
    echo 'OK !!!';
} else {
    echo '### BUG ###';
}
echo "\n";

echo "Test unitaire de la fonction createFilmMaker : ";
$newFilmMaker = [
    'filmmakersnumber' => 1234567,
    'lastname' => 'Meili',
    'firstname' => 'Dmitri',
    'birthname' => '2000-05-01',
    'nationality' => 'Russe'
];
createFilmMaker($newFilmMaker);
$readback = getFilmMakerByName("Meili");
if ($readback['firstname'] == 'Dmitri') {
    echo 'OK !!!';
}
{
    echo '### BUG ###';
}
echo "\n";

?>