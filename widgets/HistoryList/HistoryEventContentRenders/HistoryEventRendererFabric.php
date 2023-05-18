<?php

namespace app\widgets\HistoryList\HistoryEventContentRenders;

use app\models\History;
use app\widgets\HistoryList\exceptions\NotFoundEventRenderereClassException;
use yii\web\NotFoundHttpException;
use yii\web\View;

class HistoryEventRendererFabric
{
    /**
     * @var History
     */
    public $model;

    /**
     * @var View
     */
    public $view;

    /**
     * @param History $model
     * @param View $view
     */
    public function __construct(History $model, View $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    /**
     * @throws NotFoundEventRenderereClassException
     */
    public function getRenderer(): HistoryEventContentRendererInterface
    {
        $namespace = 'app\widgets\HistoryList\HistoryEventContentRenders\\';
        $rendererClassName = $namespace . 'Event' . str_replace("_", "", ucwords($this->model->event, '_')) . 'Renderer';

        if (!class_exists($rendererClassName)) {
            throw new NotFoundEventRenderereClassException("Not fount renderer class for event: {$this->model->event}");
        }

        return new $rendererClassName($this->model, $this->view);
    }
}