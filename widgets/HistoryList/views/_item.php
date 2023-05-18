<?php
use app\models\search\HistorySearch;
use app\widgets\HistoryList\exceptions\NotFoundEventRenderereClassException;
use app\widgets\HistoryList\HistoryEventContentRenders\HistoryEventRendererFabric;

/** @var $model HistorySearch */

try {
    $historyEventRendererFabric = new HistoryEventRendererFabric($model, $this);
    $historyEventRendererFabric->getRenderer()->render();
} catch (NotFoundEventRenderereClassException $e) {
    // some code
}
