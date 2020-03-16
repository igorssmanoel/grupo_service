<?php include HEADER_TEMPLATE; ?>

<div class="ui container">
    <form class="ui form inverted" action="" method="POST">
        <h3 class="ui dividing header inverted"><?php echo $vars['tournament']->name; ?></h3>
        <div class="ui cards">

            <?php foreach ($vars['tournament']->teams()->get() as $team) : ?>

                <div class="card green">
                    <div class="content">
                        <div class="header">
                            <?php echo $team->name; ?>
                        </div>
                        <div class="meta">
                        </div>
                        <div class="description">
                            <?php echo $team->first_player; ?> / <?php echo $team->second_player; ?>
                        </div>
                    </div>
                    <div class="extra content">
                        <div class="field">
                            <input type="number" name="score" placeholder="Pontuação" value="<?php echo $team->pivot->score ?>" id="<?php echo $team->id; ?>">
                        </div>
                        <div class="ui buttons">
                            <div class="ui green inverted button" onclick="updateScore(<?php echo $vars['tournament']->id; ?>, <?php echo $team->id; ?>)">Salvar</div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
        <br>
        <a class="ui button inverted red" type="buttton" href="/">Voltar</a>
    </form>
</div>

<?php include FOOTER_TEMPLATE; ?>

<script>
    function updateScore(tournament_id, team_id) {
        let score = $('#' + team_id).val();
        console.log(tournament_id, team_id, score);
        $.ajax({
            url: '?r=/tournament/score',
            method: 'POST',
            data: {
                tournament_id,
                team_id,
                score
            },
            success: (msg) => {
                msg = JSON.parse(msg);
                console.log(msg);
                if (msg == 'updated') {
                    Notiflix.Notify('Pontuação atualizada com sucesso');
                } else if (
                    msg.winner == true
                ) {
                    Notiflix.Report.Success('Vencedor',
                        msg.tournament.rule, 'Ok');

                }
            },
            error: (err) => {
                console.log(err);
            }
        });

    }
</script>