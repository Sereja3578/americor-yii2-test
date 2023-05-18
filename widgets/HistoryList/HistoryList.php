<?php

namespace app\widgets\HistoryList;

use app\widgets\HistoryList\exceptions\InvalidExportTypeException;
use app\widgets\HistoryList\exceptions\InvalidHistoryDataProvider;
use kartik\export\ExportMenu;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class HistoryList extends Widget
{
    /**
     * @var string
     */
    public $linkExport;
    /**
     * @var string
     */
    public $exportType;
    /**
     * @var array
     */
    private $availableExportTypes = [
        ExportMenu::FORMAT_CSV
    ];

    /**
     * @var ActiveDataProvider
     */
    public $historyDataProvider;

    /**
     * @throws InvalidExportTypeException
     * @throws InvalidHistoryDataProvider
     */
    public function init()
    {
        if (!in_array($this->exportType, $this->availableExportTypes)) {
            throw new InvalidExportTypeException('exportType parameter must be one of: ' .
                join(', ', $this->availableExportTypes) . ', type ' . $this->exportType . ' given'
            );
        }

        if (!$this->historyDataProvider) {
            throw new InvalidHistoryDataProvider('historyDataProvider is required');
        }

        parent::init();
    }

    /**
     * @return string
     */
    public function run(): string
    {
        return $this->render('main', [
            'linkExport' => $this->getLinkExport(),
            'historyDataProvider' => $this->historyDataProvider
        ]);
    }

    /**
     * @return string
     */
    private function getLinkExport(): string
    {
        return Url::to([
            $this->linkExport,
            'exportType' => $this->exportType
        ]);
    }
}
