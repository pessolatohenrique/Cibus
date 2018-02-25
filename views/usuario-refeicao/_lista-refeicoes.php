<div class="row">
<?php

use app\models\UsuarioRefeicao;
foreach($meals as $key => $meal):
    $first_meal = $meal[0];
?>
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-border box-info">
            <div class="box-header with-border">
                <h4 class="custom-title"><?=$first_meal->refeicao->descricao?></h4>
                <p>
                    Refeição realizada em <strong><?=$first_meal->data_consumo?></strong> 
                    às <strong><?=$first_meal->horario_consumo?></strong>
                </p>
            </div>
            <div class="box-body">
                <table class="table tabela-refeicao">
                    <thead>
                        <tr>
                            <th>Alimento</th>
                            <th>Grupo Alimentar</th>
                            <th>Quantidade</th>
                            <th>Medida Caseira</th>
                            <th>Calorias</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach($meal as $key => $food):
                        ?>
                            <tr>
                                <td><?=$food->alimento->descricao?></td>
                                <td><?=$food->alimento->grupo->descricao?></td>
                                <td><?=$food->quantidade?></td>
                                <td><?=$food->alimento->medida_caseira?></td>
                                <td><?=$food->calorias_total?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        <tr>
                            <td colspan="2">Total em quantidade</td>
                            <td><?=UsuarioRefeicao::sumQuantity($meal)?></td>
                            <td>Total em calorias</td>
                            <td><?=UsuarioRefeicao::sumCalories($meal)?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    endforeach;
    ?>
</div>