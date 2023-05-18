<?php

/**
 * @var $this View
 * @var $model History
 * @var $dataProvider ActiveDataProvider
 * @var $exportType string
 */

use app\models\History;
use app\widgets\Export\Export;
use app\widgets\HistoryList\exceptions\NotFoundEventRenderereClassException;
use app\widgets\HistoryList\HistoryEventContentRenders\HistoryEventRendererFabric;
use yii\data\ActiveDataProvider;
use yii\web\View;

$filename = 'history';
$filename .= '-' . time();

ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');
?>

<?= Export::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'ins_ts',
            'label' => Yii::t('app', 'Date'),
            'format' => 'datetime'
        ],
        [
            'label' => Yii::t('app', 'User'),
            'value' => function (History $model) {
                return isset($model->user) ? $model->user->username : Yii::t('app', 'System');
            }
        ],
        [
            'label' => Yii::t('app', 'Type'),
            'value' => function (History $model) {
                return $model->object;
            }
        ],
        [
            'label' => Yii::t('app', 'Event'),
            'value' => function (History $model) {
                return $model->eventText;
            }
        ],
        [
            'label' => Yii::t('app', 'Message'),
            'value' => function (History $model) {
                try {
                    $historyEventRendererFabric = new HistoryEventRendererFabric($model, $this);
                    $message = $historyEventRendererFabric->getRenderer()->getBody();
                } catch (NotFoundEventRenderereClassException $e) {
                    return '';
                }
                return strip_tags($message);
            }
        ]
    ],
    'exportType' => $exportType,
    'batchSize' => 2000,
    'filename' => $filename
]);