<main>
    <section class="panel">
        <div class="title"><h1><?= $this->title?></h1></div>
        <form method="POST" id="form-cadastro">
            <div>
                <label for="nickname">
                    Nickname
                </label>
                <input type="text" name="nickname" id="nickname">
            </div>
            <div>
                <label for="login">
                    E-mail
                </label>
                <input type="email" name="login" id="login">
            </div>
            <div>
                <label for="senha">
                    Senha
                </label>
                <input type="senha" name="senha" id="senha">
            </div>

            <hr>

            <div class="controls">
                <button type="button"
                    onclick="window.location.href='<?= HOME_URI?>/jogadores'"
                    class="bt bt-primary">
                    Voltar
                </button>

                <button class="bt bt-success">Inserir</button>
            </div>
        </form>
    </section>
</main>

<script>
$('#form-cadastro').submit((event) => {
    let nickname = $('#nickname').val();
    if (nickname == '') {
        exibeNotificacao(
            'Erro',
            'O nickname é um campo obrigatório',
            'error'
        );
        event.preventDefault();
        return;
    }

    let login = $('#login').val();
    if (login == '') {
        exibeNotificacao(
            'Erro',
            'O E-mail é um campo obrigatório',
            'error'
        );
        event.preventDefault();
        return;
    }

    let senha = $('#senha').val();
    if (senha == '') {
        exibeNotificacao(
            'Erro',
            'A senha é um campo obrigatório',
            'error'
        );
        event.preventDefault();
        return;
    }
});
</script>
