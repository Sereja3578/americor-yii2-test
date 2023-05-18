<?php

namespace app\widgets\HistoryList\HistoryEventContentRenders;

use app\models\History;
use yii\web\View;

interface HistoryEventContentRendererInterface
{
    public function render(): void;
    public function getBody(): string;
    public function __construct(History $model, View $view);
}