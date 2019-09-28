<div class="grafico-gerado">
    <?php
        if (isset($from_dashboard) && empty($pesos)):
    ?>
        <p class="pesquisa-invalida">
            Não encontramos resultados!
        </p>
    <?php
        endif;
    ?>       
    <?php if (!empty($pesos)): ?>
    <?=\dosamigos\highcharts\HighCharts::widget([
        'clientOptions' => [
            'title' => [
                'text' => isset($from_dashboard) ? '' : 'Histórico de Peso'
             ],
            'xAxis' => [
                'categories' => $datas_lancamento
            ],
            'yAxis' => [
                'title' => [
                    'text' => 'Pesos'
                ]
            ],
            'legend' => [
                'layout' => 'vertical',
                'align' => 'right',
                'verticalAlign' => 'middle'
            ],
            'plotOptions' => [
                'series' => [
                    'label' => [
                        'connectorAllowed' => false
                    ],
                    'pointStart' => 0
                ]
            ],
            'series' => [
                [
                    'name' => 'Pesos',
                    'data' => $pesos
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
                        endif;
    ?>
</div>