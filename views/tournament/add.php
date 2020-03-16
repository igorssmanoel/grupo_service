<?php include HEADER_TEMPLATE; ?>

<div class="ui container">
    <form class="ui form inverted" action="?r=/tournament/add" method="POST">
        <h3 class="ui dividing header inverted">Novo torneio</h3>
        <div class="field required">
            <label>Nome</label>
            <input type="text" name="name" placeholder="Nome do torneio">
        </div>
        <div class="field required">
            <label>Prêmio</label>
            <input type="text" name="prize" placeholder="Premiação">
        </div>
        <div class="field required">
            <label>Pontuação</label>
            <input type="number" name="score" placeholder="Pontuação máxima">
        </div>
        <div class="field required">
            <label>Regras</label>
            <textarea type="text" name="rule" placeholder="Regras" rows="4"></textarea>
        </div>
        <div class="field">
            <label>Times</label>
            <select class="ui fluid search dropdown" multiple="" name="teams[]">
                <option value="">Times</option>
                <?php foreach ($vars['teams'] as $team) : ?>
                    <option value="<?php echo $team->id ?>"><?php echo $team->name; ?></option>
                <?php endforeach; ?>

            </select>
        </div>

        <button class="ui button inverted green" type="submit">Salvar</button>
        <a class="ui button inverted red" type="buttton" href="/">Cancelar</a>
    </form>
</div>

<?php include FOOTER_TEMPLATE; ?>

<script>
    $('.ui.dropdown')
        .dropdown();
</script>