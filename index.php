<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'getComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) { 
            getComment($_GET['id']);
            }
            else {
                throw new Exception('Aucun identifiant de commentaire envoyé !');
            }
        }
        elseif ($_GET['action'] == 'updateComment'){
            if (isset($_GET['id']) && $_GET['id'] > 0)
            {
                if (!empty($_POST['comment'])){
                updateComment($_GET['id'], $_POST['comment']);
                } else{
                    throw new Exception('La modification est un échec !');
                    }
            } else {
            throw new Exception('Aucun identifiant de commentaire envoyé !');
            }
        }
    }
    else {
        listPosts();
        }
    }
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
