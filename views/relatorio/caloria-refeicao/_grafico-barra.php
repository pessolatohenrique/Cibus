<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-border box-info">
            <div class="box-header with-border">
                <h4 class="custom-title">Gráfico de Barras</h4>
                <p>
                    Com este gráfico, é possível visualizar o total de calorias em cada refeição.
                </p>
            </div>
            <div class="box-body">
                <?=\dosamigos\highcharts\HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'bar',
                            'height' => 520
                        ],
                        'title' => [
                            'text' => 'Calorias por Refeição'
                        ],
                        'xAxis' => [
                            'categories' => $meals_columns
                        ],
                        'yAxis' => [
                            'title' => [
                                'text' => 'Calorias'
                            ]
                        ],
                        //'series' => $arts_numbers_move
                        'series' => [
                            [
                                'name' => 'Calorias',
                                'data' => $meals_values
                            ]
                        ],
                        'responsive' => [
                            'rules' => [[
                                'condition' => [
                                    'maxWidth' => 500
                                ],
                                'chartOptions' => [
                                    'legend' => [
                                        'layout' => 'horizontal',
                                        'align' => 'center',
                                        'verticalAlign' => 'bottom'
                                    ]
                                ]
                            ]]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>

