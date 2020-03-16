<?php include HEADER_TEMPLATE; ?>

<div class="ui container">
  <h1>Sinuca</h1>
  <div class="ui segment group inverted">
    <a class="ui animated fade inverted green button" tabindex="0" href="?r=/team/add">
      <div class="visible content">Time</div>
      <div class="hidden content">
        Novo time
      </div>
    </a>
    <a class="ui animated fade inverted green button" tabindex="0" href="?r=/tournament/add">
      <div class="visible content">Campeonato</div>
      <div class="hidden content">
        Novo campeonato
      </div>
    </a>
  </div>

  <!-- Exibir campeonatos criados -->

  <table class="ui celled inverted table">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Premiação</th>
        <th>Pontuação</th>
        <th>Regras</th>
        <th>Vencedor</th>
        <th>Status</th>
        <th>Exibir</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($vars['tournaments'] as $key => $tournament) : ?>
        <tr>
          <td data-label="name"><?php echo $tournament->name ?></td>
          <td data-label="prize"><?php echo $tournament->prize ?></td>
          <td data-label="score"><?php echo $tournament->score ?></td>
          <td data-label="rule"><?php echo $tournament->rule ?></td>
          <td data-label="winner"><?php echo isset($tournament->winner) ? $tournament->winner->name : 'EM PROGRESSO'; ?></td>
          <td data-label="status"><?php echo $tournament->status->description ?></td>
          <td data-label="show">
            <?php if ($tournament->status->description == 'FINALIZADO') : ?>

              <i class="eye slash icon red"></i>

            <?php else : ?>
              <a href="<?php echo '?r=/tournament/show&id=' . $tournament->id; ?>">
                <i class="eye icon green"></i>
              </a>
            <?php endif ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


<?php include FOOTER_TEMPLATE; ?>