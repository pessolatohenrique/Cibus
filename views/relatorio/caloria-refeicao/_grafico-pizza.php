<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-border box-info">
            <div class="box-header with-border">
                <h4 class="custom-title">Gráfico de Pizza</h4>
                <p>
                    Com este gráfico, é possível visualizar a porcentagem de calorias em cada refeição.
                </p>
            </div>
            <div class="box-body">
                <?=\dosamigos\highcharts\HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'pie'
                        ],
                        'title' => [
                            'text' => 'Calorias por Refeição'
                        ],
                        'tooltip' => [
                            'pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'
                        ],
                        'legend' => [
                            'layout' => 'vertical',
                            'align' => 'right',
                            'verticalAlign' => 'middle'
                        ],
                        'plotOptions' => [
                            'pie' => [
                                'allowPointSelect' => true,
                                'cursor' => 'pointer',
                                'showInLegend' => true
                            ]
                        ],
                        'series' => [
                            [
                                'name' => 'Refeições',
                                'data' => $pizza_chart
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