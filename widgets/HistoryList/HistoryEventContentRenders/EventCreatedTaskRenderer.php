<?php

namespace app\widgets\HistoryList\HistoryEventContentRenders;

use app\models\History;
use yii\web\View;

class EventCreatedTaskRenderer implements HistoryEventContentRendererInterface
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
     * @return void
     */
    public function render(): void
    {
        $task = $this->model->task;

        echo $this->view->render('../views/_item_common', [
            'user' => $this->model->user,
            'body' => $this->getBody(),
            'iconClass' => 'fa-check-square bg-yellow',
            'footerDatetime' => $this->model->ins_ts,
            'footer' => isset($task->customerCreditor->name) ? "Creditor: " . $task->customerCreditor->name : ''
        ]);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        $task = $this->model->task;
        return "{$this->model->eventText}: " . ($task->title ?? '');
    }
}