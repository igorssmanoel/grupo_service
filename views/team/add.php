<?php include HEADER_TEMPLATE; ?>

<div class="ui container">
    <form class="ui form inverted" action="?r=/team/add" method="POST">
        <h3 class="ui dividing header inverted">Novo time</h3>
        <div class="field required">
            <label>Nome</label>
            <input type="text" name="name" placeholder="Nome do time">
        </div>
        <div class="field required">
            <label>Primeiro jogador</label>
            <input type="text" name="first_player" placeholder="Nome do primeiro jogador">
        </div>
        <div class="field required">
            <label>Segundo jogador</label>
            <input type="text" name="second_player" placeholder="Nome do segundo jogador">
        </div>

        <button class="ui button inverted green" type="submit">Salvar</button>
        <a class="ui button inverted red" type="buttton" href="/">Cancelar</a>
    </form>
</div>

<?php include FOOTER_TEMPLATE; ?>