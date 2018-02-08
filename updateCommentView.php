<?php ob_start(); ?>
<p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>

    <h1>Formulaire de modification de commentaire :</h1>
    
    <form action="index.php?action=updateComment&amp;id=<?= $commentID ?>" method="post">
        <label for="comment">Commentaire :</label><br />  
        <textarea id="comment" name="comment" value="" /><?= $comment['comment'] ?></textarea>
            <br />
		  <input type="submit" value ="Modifier" />
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
