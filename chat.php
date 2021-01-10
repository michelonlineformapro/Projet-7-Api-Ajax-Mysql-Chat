<?php

require_once "Config/Database.php";
$message = "liste";

if(array_key_exists("message", $_GET)){
    $message = $_GET['message'];
}

if($message == "ecrire"){
    postMessages();
}else{
    getMessages();
}

function getMessages(){
    $db = new Database();
    $chat = $db->getPDO();
    //Affiche les 20 derniers messages + affiche les données en JSON
    $res = $chat->query("SELECT * FROM messages ORDER BY message ASC LIMIT 10");
    $getMessages = $res->fetchAll(PDO::FETCH_BOTH);
    echo json_encode($getMessages);
}

function postMessages(){


    if(!array_key_exists('auteur', $_POST) || !array_key_exists('message', $_POST)){
        echo json_encode([
            "status" => "Erreur",
            "message" => "URL est pas bien"
        ]);
    }

    $db = new Database();
    $post = $db->getPDO();

    $sql = "INSERT INTO messages SET auteur = ?, message = ?";
    $req = $post->prepare($sql);

    //Requète insertion des datas auteur + message + date
    if(isset($_POST['auteur']) && !empty($_POST['auteur'])){
        $auteur = $_POST['auteur'];
    }else{
        echo "<p class='notification is-danger'>Merci de remplir le champ auteur</p>";
    }
    if(isset($_POST['message']) && !empty($_POST['message'])){
        $message = $_POST['message'];
    }else{
        echo "<p class='notification is-danger'>Merci de remplir le champ message</p>";
    }
    $req->bindParam(1, $auteur);
    $req->bindParam(2, $message);
    try {
        $req->execute(array($auteur, $message));
        echo json_encode(array(
            //"status" => 200,
            //"message" => "Message envoyé",
        ));
    }catch (PDOException $e){
        echo "<p class='notification is-danger'>Merci de remplir tous les champs</p>" .$e->getMessage();
    }


}


