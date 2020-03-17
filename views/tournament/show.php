<?php include HEADER_TEMPLATE; ?>

<div class="ui container">
    <form class="ui form inverted segment" action="" method="POST">
        <h3 class="ui dividing header inverted"><?php echo $vars['tournament']->name; ?></h3>
        <div class="ui segment inverted grey">
            <h3>Premiação: <?php echo $vars['tournament']->prize; ?></h3>
            <h3>Regra: <?php echo $vars['tournament']->rule; ?></h3>
            <h3>Máxima pontuação: <?php echo $vars['tournament']->score; ?></h3>
            <?php if ($vars['tournament']->status_id == 3) : ?>
                <h2>VENCEDOR: <?php echo $vars['tournament']->winner->name; ?></h2>
            <?php endif; ?>
        </div>
        <div class="ui cards" id="cards">
        </div>
        <br>
        <a class="ui button inverted red" type="buttton" href="/">Voltar</a>
    </form>
</div>

<?php include FOOTER_TEMPLATE; ?>

<script>
    function updateScore(tournament_id, team_id) {
        Notiflix.Loading.Circle();
        let score = $('#' + team_id).val();

        $.ajax({
            url: '?r=/tournament/score',
            method: 'POST',
            data: {
                tournament_id,
                team_id,
                score
            },
            success: (msg) => {
                refreshTeams();
                msg = JSON.parse(msg);

                if (msg == 'updated') {
                    Notiflix.Notify('Pontuação atualizada com sucesso');
                } else if (
                    msg.winner == true
                ) {
                    Notiflix.Report.Success('Vencedor',
                        msg.team, 'Ok');

                }
            },
            error: (err) => {
                Notiflix.Loading.Remove();
                console.log(err);
            }
        });

    }
</script>

<script>
    // Atualiza a lista dos times do campeonato
    $(window).ready(function() {
        refreshTeams();
    });

    function refreshTeams() {
        Notiflix.Loading.Circle();
        var url = new URL(window.location.href);
        var tournament_id = url.searchParams.get("id");
        $.ajax({
            url: '?r=/tournament/refresh_tournament',
            method: 'GET',
            data: {
                tournament_id
            },
            success: (response) => {
                response = JSON.parse(response);
                setTeams(response);
                Notiflix.Loading.Remove();

            },
            error: (err) => {
                Notiflix.Loading.Remove();
                console.log(err);
            }
        });
    }

    // Define o template dos cards com os times
    function setTeams(tournament) {
        $("#cards").empty();
        let disabled = "";
        if (tournament.status_id == 3) {
            disabled = 'disabled';
        }
        var teams = tournament.teams;
        var markup = `<div class="card grey">
                        <div class="content">
                            <div class="header">
                                \${name} 
                            </div>
                            <div class="meta">
                            </div>
                            <div class="description">
                                <h4> \${first_player} / \${second_player}</h4>
                            </div>
                        </div>
                        <div class="ui segment inverted grey">
                        <div class="field">
                            <input ${disabled} type="number" name="score" placeholder="Pontuação" value="\${pivot.score}" id="\${id}">
                        </div>
                        <div  class="ui bottom attached button green ${disabled}" onclick="updateScore('${tournament.id}', '\${id}')">
                            <i class="cloud upload icon"></i>
                        </div>
                    </div>
                </div>`;


        $.template("cardTemplate", markup);

        $.tmpl("cardTemplate", teams)
            .appendTo("#cards");
    }
</script>