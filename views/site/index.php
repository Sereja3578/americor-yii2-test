<?php

use app\widgets\HistoryList\HistoryList;
use kartik\export\ExportMenu;
use yii\data\ActiveDataProvider;

/* @var $dataProvider ActiveDataProvider */

$this->title = 'Americor Test';
?>

<div class="site-index">
    <?= HistoryList::widget([
            'exportType' => ExportMenu::FORMAT_CSV,
            'linkExport' => 'site/export',
            'historyDataProvider' => $dataProvider
    ]); ?>
</div>
