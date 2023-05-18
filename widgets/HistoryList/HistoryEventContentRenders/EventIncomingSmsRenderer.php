<?php

namespace app\widgets\HistoryList\HistoryEventContentRenders;

use app\models\History;
use app\models\Sms;
use Yii;
use yii\web\View;

class EventIncomingSmsRenderer implements HistoryEventContentRendererInterface
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
        echo $this->view->render('../views/_item_common', [
            'user' => $this->model->user,
            'body' => $this->getBody(),
            'footer' => $this->model->sms->direction == Sms::DIRECTION_INCOMING ?
                Yii::t('app', 'Incoming message from {number}', [
                    'number' => $this->model->sms->phone_from ?? ''
                ]) : Yii::t('app', 'Sent message to {number}', [
                    'number' => $this->model->sms->phone_to ?? ''
                ]),
            'iconIncome' => $this->model->sms->direction == Sms::DIRECTION_INCOMING,
            'footerDatetime' => $this->model->ins_ts,
            'iconClass' => 'icon-sms bg-dark-blue'
        ]);
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->model->sms->message ?: '';
    }
}