<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Jonathan Rossetto de Fraga">
    <meta name="description" content="Painel de controle para o jogo da forca">
    <meta namm="keywords" content="Painel, controle, painel do jogo">
    <meta http-equiv="content-language" content="pt-br">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="robots" content="<?= $this->robots?>">
    <title><?= $this->title?></title>
    <script src="<?= HOME_URI?>/app/views/_includes/js/jquery-3.6.0.min.js"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    *{
        margin: 0;
        padding: 0;
    }

    html,
    body{
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-family: 'Roboto', sans-serif;
        overflow: hidden;
        font-size: 1rem;
    }

    body{
        background-color: #3a4c63;
    }

    main {
        border-radius: 5px;
        width: 60%;
        height: 50%;
        background-color: #FFF;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: #989898 0px 0px 40px 2px;
        overflow: hidden;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        height: 70%;
        padding: .5rem;
    }

    div {
        display: flex;
        flex-direction: column;
        width: 90%;
        margin-top: 1rem;
    }

    label {
        color:#4e4d4d
    }

    input {
        border:none;
        border-bottom: 1px solid #989898;
        padding: .5rem;
    }

    input:focus,
    input:active,
    input:hover {
        outline: none;
        border-bottom: 2px solid #000;
    }

    button {
        width: 5rem;
        height: 2rem;
        border-radius: 30px;
        border: none;
        background-color: #3a4c63;
        color: #FFF;
        font-weight: bold;
    }

    button:focus,
    button:hover{
        outline: none;
        box-shadow: #989898 0px 0px 10px 2px;
    }

    button:active{
        outline: none;
        box-shadow: #989898 1px 1px 3px 2px;
    }

    @media(min-width:760px) {
        main {
            width: 30%;
        }
    }
</style>
<body>
    <main role="main">
        <form id="form-login">
            <div>
                <label for="email">E-mail</label>
                <input type="email" id="email" autofocus>
            </div>

            <div>
                <label for="senha">Senha</label>
                <input type="password" id="senha">
            </div>

            <span id="show-error" role="alert"></span>

            <button id="bt-login" role="button" aria-label="Pressione para fazer o login">Login</button>
        </form>
    </main>
</body>
</html>

<script>
    $('#form-login').submit((e) => {
        e.preventDefault();

        let login = $('#email').val();
        let senha = $('#senha').val();

        if (login != null && senha != null) {
            $.ajax({
                url : '<?=HOME_URI?>/login/efetua-login',
                data : {
                    'login' : login,
                    'senha' : senha
                },
                method : 'post',
                success : function(data){
                    window.location.href = '<?= HOME_URI?>';
                },
                error : function(data){
                    console.error(data);
                    $('#show-error').html(data.responseText);
                    $('#show-error').css('color', 'red');
                    setTimeout(() => {
                        $('#login').focus();
                        $('#senha').val('');
                    }, 2000);
                }
            });
        }
    });
</script>
