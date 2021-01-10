<?php
require_once "chat.php";
require_once "Config/Database.php";
$chat = new Database();
$chat->getPDO();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax MySQL Chat</title>
    <link rel="stylesheet" href="node_modules/bulma/css/bulma.css"/>
    <link rel="stylesheet" href="node_modules/bulma/css/styles.css"/>
  </head>
  <body>
  <section id="all-content" class="section">
    <div class="container">
      <h1 class="title is-size-1 has-text-centered-desktop">
        BIENVENUE SUR LE CHAT AJAX ET MYSQL
      </h1>
      <div class="subtitle">
          <div class="field">
              <label class="label">Message</label>
              <div class="control messages">
                  <div id="chat-container">
                        <div>
                            <span id="auteur" class="auteur"></span>
                            <span id="message" class="message"></span>
                        </div>
                  </div>
              </div>
          </div>
            <form action="index.php?message=ecrire" method="post">
              <div class="field">
                  <label class="label">Username</label>
                  <div class="control">
                      <input class="input is-success" type="text" placeholder="Vous" name="auteur">
                      <br /><br />
                      <input class="input is-success" type="text" placeholder="Votre message" name="message">
                  </div>
                  <p class="help is-success">Merci de ne pas propager de contenus haineux ou d'insulte visant un membre</p>
              </div>
                <button type="submit" class="button is-info">Envoyé</button>
            </form>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="js/app.js"></script>
  <script>
      getAjaxMessages();
  </script>
  </body>
</html>
