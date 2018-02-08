<?php

namespace Blogphp\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

     public function getComment($commentID)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, comment, post_id FROM comments WHERE id = ?');
        $req->execute(array($commentID));
        $comment = $req->fetch();
            
        return $comment;
    }
    
    public function postComment($postID, $author, $comment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $comment = $req->execute(array($postID, $author, $comment));

        return $comment;
    }
    
    public function updateComment($commentID, $comment)
    {
    $db = $this->dbConnect();
    $req = $db->prepare('UPDATE comments SET comment = ? WHERE id= ?');
    $comment = $req->execute(array($comment,$commentID));
    
    return $comment;
    }
    
   
    
    /*public function deleteComment($comment)
    {
    $db = $this->dbConnect();
    $comment = $db->prepare('DELETE FROM comments WHERE comment');
    $affectedLines = $comment->execute(array($comment));
    }*/
}
