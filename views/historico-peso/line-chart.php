<div class="grafico-gerado">
    <?=\dosamigos\highcharts\HighCharts::widget([
        'clientOptions' => [
            'title' => [
                'text' => 'Histórico de Peso'
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
    ?>
</div>