<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-border box-info">
            <div class="box-header with-border">
                <h4 class="custom-title">Café da Manhã</h4>
                <p>Refeição realizada em <strong>13/02/2018</strong> às <strong>07:30</strong></p>
            </div>
            <div class="box-body">
                <table class="table tabela-refeicao">
                    <thead>
                        <tr>
                            <th>Alimento</th>
                            <th>Grupo Alimentar</th>
                            <th>Quantidade</th>
                            <th>Medida Caseira</th>
                            <th>Calorias (KCAL)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        for ($i = 1; $i < 5; $i++):
                        ?>
                            <tr>
                                <td>Suco de Maracujá</td>
                                <td>Frutas</td>
                                <td>1</td>
                                <td>Um Copo de 250ml</td>
                                <td>200</td>
                            </tr>
                        <?php
                        endfor;
                        ?>
                        <tr>
                            <td colspan="2">Total em quantidade</td>
                            <td>5</td>
                            <td>Total em calorias</td>
                            <td>1000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>