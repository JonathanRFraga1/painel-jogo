<main>
    <section class="panel">
        <div class="title"><h1><?= $this->title?></h1></div>
        <div class="controls-main">
            <div class="">
                <button class="bt bt-primary"
                    onclick="window.location.href='<?= HOME_URI?>/jogadores/inserir'">
                    Cadastrar novo Jogador
                </button>
            </div>

            <form role="search" class="busca" id="form-busca">
                <input type="search" id="busca" placeholder="Buscar pelo nickname ou pelo e-mail" autocomplete="off">
            </form>
        </div>

        <div class="table">
            <table>
                <thead>
                    <td>ID</td>
                    <td>Nickname</td>
                    <td>Pontuação</td>
                </thead>
                <tbody id="tbody">
                <?php foreach ($this->jogadores as $jogador) {?>
                    <tr>
                        <td><?= $jogador['id']?></td>
                        <td><?= $jogador['nickname']?></td>
                        <td><?= $jogador['pontuacao']?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </section>
</main>

<script>
    $('#form-busca').submit((event) => {
        event.preventDefault();
        $.ajax({
            url : '<?= HOME_URI?>/jogadores/busca-texto',
            data : {
                'texto' : $('#busca').val()
            },
            method : 'post',
            success : function(data){
                data = JSON.parse(data);

                console.log(data);

                $('#tbody').html('');

                for (let i in data) {
                    let jogador = data[i];
                    $('#tbody').append(
                        `<tr>
                            <td>${jogador.id}</td>
                            <td>${jogador.nickname}</td>
                            <td>${jogador.login}</td>
                            <td>${jogador.pontuacao}</td>
                        </tr>`
                    );
                }
            },
            error : function(data){
                console.error(data);
            }
        });
    })
</script>
