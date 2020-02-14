<?php

function getAllFilmMakers()
{
    $dbh = callPDO();
    try {

        $query = 'SELECT * FROM filmmakers';
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getFilmMaker($id)
{
    $dbh = callPDO();
    try {

        $query = "SELECT * FROM filmmakers WHERE id=$id";
        $statment = $dbh->prepare($query);//prepare query
        $statment->execute();//execute query
        $queryResult = $statment->fetch(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getFilmMakerByName($name)
{
    $dbh = callPDO();
    try {

        $query = "SELECT * FROM filmmakers WHERE lastname='$name'";
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetch(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function updateFilmMaker($filmMaker)
{
    $dbh = callPDO();
    try {

        $query = "UPDATE filmakers SET
                          filmmakersnumber=:filmmakersnumber,
                            firstname =:firstname,
                            lastname=:lastname,
                            birthname=:birthname,
                            nationality=:nationality
                            WHERE id =:id";
        var_dump($filmMaker);
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute($filmMaker);//execute query
        $queryResult = $statement->fetch(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        var_dump($queryResult);
        return $queryResult;

    }catch(PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }

}
function callPDO(){
    require ".const.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;

}

// ############################## Tests unitaires ####################

// Recharger la base de données pour être sûr à 100% des données de test
require ".const.php";
$cmd = "mysql - u $user - p$pass < Restore - MCU - PO -Final.sql";
exec($cmd);


echo "Test unitaire de la fonction getAllItems : ";
$items = getAllFilmMakers();
if (count($items) == 4)
{
    echo 'OK !!!';
}
else
{
    echo 'BUG !!!';
}
echo "\n";

echo "Test unitaire de la fonction getItem : ";
$item = getFilmMaker(3);
if ($item['firstname'] == 'Luc-Olivier')
{
    echo 'OK !!!';
}
else
{
    echo 'BUG !!!';
}
echo "\n";

echo "Test unitaire de la fonction getFilmMakerName : ";
$item = getFilmMakerByName('Chamblon');
if ($item['id'] == 3)
{
    echo 'OK !!!';
}
else
{
    echo '### BUG ###';
}
echo "\n";

echo "Test unitaire de la fonction updateFilmMaker : ";
$item = getFilmMakerByName('Chamblon');
$id = $item['id']; // se souvenir de l'id pour comparer
$item['firstname'] = 'Gérard';
$item['lastname'] = 'Menfain';
updateFilmMaker($item);
$readback = getFilmMaker($id);
if (($readback['firstname'] == 'Gérard') && ($readback['lastname'] == 'Menfain'))
{
    echo 'OK !!!';
}
else
{
    echo '### BUG ###';
}
echo "\n";

?>