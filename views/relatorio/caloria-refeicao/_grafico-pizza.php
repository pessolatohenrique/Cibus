<?php
    $from_dashboard = isset($from_dashboard);
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="box box-border box-info">
            <div class="box-header with-border">
                <h4 class="custom-title">
                    <?= $from_dashboard ? "Calorias por refeição": "Gráfico de Pizza" ?>
                </h4>
                <?php 
                    if (!$from_dashboard):
                ?>
                    <p>
                        Com este gráfico, é possível visualizar a porcentagem de calorias em cada refeição.
                    </p>
                <?php
                    endif;
                ?>
            </div>
            <div class="box-body">
                <?php
                if (!empty($pizza_chart)):
                ?>
                    <?=\dosamigos\highcharts\HighCharts::widget([
                        'clientOptions' => [
                            'chart' => [
                                'type' => 'pie'
                            ],
                            'title' => [
                                'text' => $from_dashboard ? "" : "Calorias por refeição"
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
                <?php
                else:
                ?>
                    <p class="pesquisa-invalida">
                        Não encontramos resultados!
                    </p>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</div>