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

        $query = "UPDATE filmmakers SET
                          filmmakersnumber=:filmmakersnumber,
                            firstname =:firstname,
                            lastname=:lastname,
                            birthname=:birthname,
                            nationality=:nationality
                            WHERE id =:id";

        $statement = $dbh->prepare($query);//prepare query
        $statement->execute($filmMaker);//execute query
        $queryResult = $statement->fetch(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;

        return $queryResult;

    }catch(PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }

}
function createFilmMaker($filmMaker){
    $dbh = callPDO();
    try{
        $query = "INSERT INTO filmmakers (filmmakersnumber,lastname,firstname,birthname,nationality) values (1234567,'Meili','Dmitri','2000-05-01','Russe')";
        var_dump($query);
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetch(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;

    }catch (PDOException $e){
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }

}

//function getFilmMaker($id){}


function getFilmMakers(){

}
function getFilmMakersByName($name){

}
//function updateFilmMaker($filmMaker){}


function deleteFilmMaker($id){

}
function callPDO()
{
    require ".const.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;
}

?>