

//Ajax
//On recup les données de la bd qui à été encodé en JSON
function getAjaxMessages(){
    //la fonction creer une requète AJAX pour se connecter au serveur apache et se lié au fichier chat.php
    //Instance Ajax
    const requeteAjax = new XMLHttpRequest()
    //Pour openen Ajax method (get, post, put(patch), delete en http + nom du fichier sans param)
    requeteAjax.open("GET", "./chat.php")
    //On recois les données encodées en JSON puis on les traites et les affiche au format HTML
    requeteAjax.onload = function (){
        //Tranforme le json en objet
        //La méthode JSON.parse() analyse une chaîne de caractères JSON et construit la valeur JavaScript ou l'objet décrit par cette chaîne.
        const resultat = JSON.parse(requeteAjax.responseText)
        //La méthode map() crée un nouveau tableau avec les résultats de l'appel d'une fonction fournie sur chaque élément du tableau appelant.
        const html = resultat.map(function(message){
            return `
             <div class="control messages">
                  <div id="chat-container">
                        <div class="message">
                            <span class="auteur">${message.auteur} : </span>
                            <span class="message">${message.message}</span>
                        </div>
                  </div>
              </div>
        `
        }).join('')
        //console.log(html);
        //Stock et recup la classe .message
        const messages = document.querySelector('.message')
        //injecte de html soit le contenu du tableau parsé html
        messages.innerHTML = html
        //retourne en haut lors de affichage d'un nouveau message
        messages.scrollTop = messages.scrollHeight
    }
    //envoie le requète ajax
    requeteAjax.send();

}


function postAjaxMessages(event){
    //Stop le comortement habituel du submit form
    event.stopPropagation()
    //Recup des id du formulaire
    const auteur = document.querySelector("#auteur")
    const message = document.querySelector("#message")
    //les conditions
    //L'interface FormData permet de construire facilement un ensemble de
    // paires clé/valeur représentant les champs du formulaire et leurs valeurs,
    // qui peuvent ensuite être facilement envoyées en utilisant
    // la méthode XMLHttpRequest.send() de l'objet XMLHttpRequest.
    // Il utilise le même format qu'utilise un
    // formulaire si le type d'encodage est mis à "multipart/form-data".
    const data = new FormData()
    //recupération du champs input
    //append() insert un contenu au dernier enfant de chaque element
    //Pour inserer dans le premier enfant c prepend()
    data.append('auteur', auteur.value)
    data.append('message', message.value)

    //requète Ajax method post + envoi des données
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "./chat.php?message=ecrire")
    //Quand la requète est executée
    requeteAjax.onload = function (){
        //efface input
        message.value = ''
        //et remet le curseur dans le champs message
        message.focus()
        //on re-affiche les derniers messages
        getAjaxMessages()
    }
    //envoi de la requète + les donnée des 2 champs du formulaire
    requeteAjax.send(data)

}

//Traitement du formulaire en general
document.querySelector('form').addEventListener('submit',  postAjaxMessages);
const interval = window.setInterval(getAjaxMessages, 3000);



