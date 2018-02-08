<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

// Chargement des classes
use \Blogphp\Model\PostManager;
use \Blogphp\Model\CommentManager;

function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new PostManager();
    $commentManager = new CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    
    require('view/frontend/postView.php');
}

function addComment($postID, $author, $comment)
{
    $commentManager = new CommentManager();
    
    $affectedComment = $commentManager->postComment($postID, $author, $comment);
    
    if($affectedComment == false){
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location : index.php?action=post&id=' . $postID);
    }
}

function getComment($commentID)
{
    $commentManager = new CommentManager();
    
    
    $comment = $commentManager->getComment($_GET['id']);
    
    require('view/frontend/updateCommentView.php');
}

function updateComment($commentID, $comment)
{
    $commentManager = new CommentManager();
    
    $affectedComment = $commentManager->updateComment($commentID, $comment);
    
    $comment = $commentManager->getComment($commentID);
    $postID = $comment['post_id'];
    
    $comment='Test';
    
    if($affectedComment == false){
        throw new Exception('Erreur lors de la modification !');
    }
    else {
        header('Location: index.php?action=listPosts');
        //echo "<script type='text/javascript'>window.location.href = 'index.php?action=listPosts';</script>'";
        exit();

    }
}