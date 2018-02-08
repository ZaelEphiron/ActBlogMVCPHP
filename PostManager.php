<?php

namespace Blogphp\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date_fr DESC LIMIT 0, 5');
        return $req;
    }

    public function getPost($postID)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postID));
        $post = $req->fetch();

        return $post;
    }
    
    /*public function updatePost($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE post SET title, content');
        $req->execute(array($title, $content));
    }*/

    /*public function deletePost($title, $content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM posts WHERE post');
        $req->execute(array($title, $content);
    }*/
}
