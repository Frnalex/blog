<?php
$this->title = 'Contact';
echo $this->session->show('email_send');
echo $this->session->show('email_error');


include('set_token.php');

$name = isset($post) ? htmlspecialchars($post->get('name')) : '';
$email = isset($post) ? htmlspecialchars($post->get('email')) : '';
$message = isset($post) ? htmlspecialchars($post->get('message')) : '';

?>

<div class="page-title">
    <h1 class="text-lg">Contact.</h1>
    <p class="text">Une question ? Juste envie de dire bonjour ?</p>
    <p class="text">Remplissez le formulaire ci-dessous et je vous répondrai le plus vite possible.</p>
</div>

<div>
    <form class="form" method="POST" action="/index.php?route=contact">

        <div class="form-group">
            <input type="text" placeholder="Nom" id="name" name="name" value="<?php echo $name ?>">
            <?php if (isset($errors['name'])) { ?>
            <p class="text-alert"><?php echo $errors['name'] ?></p>
            <?php } ?>
        </div>

        <div class="form-group">
            <input type="email" placeholder="Email" id="email" name="email" value="<?php echo $email ?>">
            <?php if (isset($errors['email'])) { ?>
            <p class="text-alert"><?php echo $errors['email'] ?></p>
            <?php } ?>
        </div>

        <div class="form-group">
            <textarea name="message" id="message" placeholder="Message"><?php echo $message ?></textarea>
            <?php if (isset($errors['message'])) { ?>
            <p class="text-alert"><?php echo $errors['message'] ?></p>
            <?php } ?>
        </div>

        <input name="token" type="hidden" value="<?php echo $this->session->get('token') ?>">

        <input class="btn" type="submit" value="Envoyer" id="submit" name="submit">
    </form>
</div>