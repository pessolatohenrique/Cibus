<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;

$isVisitor = Yii::$app->user->isGuest;
$foto_perfil = !$isVisitor?Yii::$app->user->identity->photo:"";

if(!$isVisitor):
	//monta a imagem da navbar
	$image = Html::beginTag("div");
	$image .=  Html::img('@web/'.$foto_perfil,[
		'class' => 'img-circle profile-image',
		'alt' => 'Perfil'
	]);
	$image .= Yii::$app->user->identity->username;
	$image .= Html::endTag("div");

	NavBar::begin([
	    'brandLabel' => Yii::$app->name,
	    'innerContainerOptions' => ['class' => 'container-fluid'],
	    'options' => ['class' => 'navbar navbar-nav navbar-default navbar-fixed-top'],
	]);

	echo Nav::widget([
		'encodeLabels' => false,
	    'items' => [
	        [
	        	'label' => 'Home', 
	        	'url' => ['/site/index'], 
	        	'options' => ['class' => 'navbar-align'],
	        	'active' => false
	        ],
	        [
	        	'label' => 'Page 1', 
	        	'items' => [
	        		['label' => 'Page 1-1', 'url' => ['#']],
	        		['label' => 'Page 1-2', 'url' => ['#']],
	        	],
	        	'options' => ['class' => 'navbar-align'],
	        ],
	        [
	        	'label' => 'Page 2', 
	        	'url' => ['#'],
	        	'options' => ['class' => 'navbar-align'],
	        ],
	        [
	        	'label' => 'Page 3', 
	        	'url' => ['#'],
	        	'options' => ['class' => 'navbar-align'],
	        ],
	        [
	        	'label' => 'Configurações',
	        	'url' => ['#'],
	        	'options' => ['class' => 'option-mobile']
	        ],
	        [
	        	'label' => 'Logout',
	        	'url' => ['/site/logout'],
	        	['data-method' => 'post'],
	        	'options' => ['class' => 'option-mobile']
	        ]
	    ],
	    'options' => ['class' => 'navbar-nav'],
	]);

	echo Nav::widget([
		'encodeLabels' => false,
		'items' => [
	        [
	        	'label' => $image,
	        	'items' => [
	        		[
	        			'label' => 'Configurações', 
	        			'url' => ['/user/update', 'id' => Yii::$app->user->identity->id]
	        		],
	        		[
	        			'label' => 'Logout', 
	                	'url' => ['/site/logout'],
	                    'linkOptions' => ['data-method' => 'post']
	        		],
	        	],
	        	'options' => ['class' => 'option-right']
	        ]
		],
	    'options' => ['class' => 'navbar-nav pull-right	'],
	]);
	NavBar::end();
endif;
?>