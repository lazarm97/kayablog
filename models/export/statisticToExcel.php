<?php
require_once('../../config/connection.php');
require_once('../../models/edit/functions/functions.php');

$poseceneStranice = poseceneStranice();
// Pokretanje Excel aplikacije
$excel = new COM("Excel.Application");


// Da bi se fizički videlo otvaranje fajla
$excel->Visible = 1;

// recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
$excel->DisplayAlerts = 1;

// Otvaranje Excel fajla
$workbook = $excel->Workbooks->Add();

// Otvaranje Sheet
$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;

$poljeA = $sheet->Range("A1");
$poljeA->activate;
$poljeA->value = "Naziv stranice";

$poljeB = $sheet->Range("B1");
$poljeB->activate;
$poljeB->value = "Broj posete u procentima";

$br = 2;
for($i=0; $i<count($poseceneStranice); $i++){
    // U A kolonu upisujemo naziv stranice
    $polje = $sheet->Range("A{$br}");
    $polje->activate;
    $polje->value = $poseceneStranice[$i];

    // U B kolonu upisujemo procenat
    $polje = $sheet->Range("B{$br}");
    $polje->activate;
    $polje->value = brojPosecenostiStraniceProtekla24Sata($poseceneStranice[$i]).'%';

    $br++;
}
// http://localhost/models/export/
// Cuvanje promena u fajla
$workbook->_SaveAs("statistika.xlsx");
// $workbook->Save();

// Zatvaranje Excel fajla
// $workbook->Saved=true;
// $workbook->Close;

// $excel->Workbooks->Close();
// $excel->Quit();

// header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
// header('Content-Disposition: attachment; filename="file.xlsx"');

// unset($sheet);
// unset($workbook);
// unset($excel);

header("Location:../../views/pages/edit.php");