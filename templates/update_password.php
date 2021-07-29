<?php $this->title = 'Modifier mot de passe' ?>

<div>
    <p>Le mot de passe de <?php echo $this->session->get('pseudo') ?> sera modifié</p>

    <form method="POST" action="/index.php?route=updatePassword">
        <label for="password">Mot de passe</label><br>
        <input type="password" id="password" name="password"><br>

        <input name="token" type="hidden" value="<?php echo $this->session->get('token') ?>">

        <input type="submit" value='Mettre à jour' id="submit" name="submit">
    </form>
</div>