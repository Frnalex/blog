<footer class="footer">
    <div class="container footer__content">

        <div>
            <p class="text"><a class="link-alt" href="#">GitHub</a> / <a class="link-alt" href="#">Instagram</a></p>
            <p class="text">2021 © Alexandre Fournou</p>
        </div>

        <?php if ($this->session->get('role') === 'admin') { ?>
        <div>
            <a class="link-alt" href="/index.php?route=administration">Administration</a>
        </div>
        <?php } ?>

    </div>
</footer>