</body>
<script src="<?= HOME_URI?>/app/views/_includes/js/scripts.js"></script>
<script>
    $('#bt-main-menu').click(() => {
        let menu = $('#main-menu');

        if (menu.hasClass('show')) {
            menu.removeClass('show');
            $('#bt-main-menu').attr('aria-label', 'clique para exibir o menu do sistema');
        } else {
            menu.addClass('show');
            $('#bt-main-menu').attr('aria-label', 'clique para ocultar o menu do sistema');
        }
    });

        <?php
        if (!empty($this->notification)) {
            ?>
            exibeNotificacao(
                '<?= $this->notification['title']?>',
                '<?= $this->notification['content']?>',
                '<?= $this->notification['type']?>'
            );
            <?php
        }
        ?>
</script>
</html>
