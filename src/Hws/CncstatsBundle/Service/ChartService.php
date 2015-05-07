<?php

namespace Hws\CncstatsBundle\Service;
use SaadTazi\GChartBundle\DataTable;

class ChartService {
    public function generateRankingDataTableArray($label, $rowsTitles, $rowsValues) {
        return $this->generateDataTableArray($label, $rowsTitles, $rowsValues);
    }

    public function generateDataTableArray($label, $rowsTitles, $rowsValues) {
        $dataTable = new DataTable\DataTable();
        $dataTable->addColumn('date', 'Date', 'string');
        $dataTable->addColumnObject(new DataTable\DataColumn('id', $label, 'number'));

        for ($i = 0, $count = count($rowsValues); $i < $count; $i++) {
            $dataTable->addRow(array($rowsTitles[$i], isset($rowsValues[$i]) ? (int) $rowsValues[$i] : 0));
        }

        return $dataTable->toArray();
    }

    public function generateCompareDataTableArray($label1, $label2, $rowsTitles, $rowsValues) {
        $dataTable = new DataTable\DataTable();
        $dataTable->addColumn('date', 'Date', 'string');
        $dataTable->addColumnObject(new DataTable\DataColumn('id', $label1, 'number'));
        $dataTable->addColumnObject(new DataTable\DataColumn('id', $label2, 'number'));

        for ($i = 0, $count = count($rowsTitles); $i < $count; $i++) {
            $dataTable->addRow(array($rowsTitles[$i], isset($rowsValues[$rowsTitles[$i]][0]) ? (int) $rowsValues[$rowsTitles[$i]][0] : 0, isset($rowsValues[$rowsTitles[$i]][1]) ? (int) $rowsValues[$rowsTitles[$i]][1] : 0));
        }

        return $dataTable->toArray();
    }
}
