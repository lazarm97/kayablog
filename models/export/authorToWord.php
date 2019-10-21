<?php

$word = new COM("Word.Application");

// Hide MS Word application window
$word->Visible = 1;

//Create new document
$word->Documents->Add();
// Define page margins 
$word->Selection->PageSetup->LeftMargin = '2';
$word->Selection->PageSetup->RightMargin = '2';

// Define font settings
$word->Selection->Font->Name = 'Arial';
$word->Selection->Font->Size = 10;
// Add text
$word->Selection->TypeText("Zovem se Lazar Marojkin, rođen sam u Kikindi 22.09.1997. Završio sam Gimnaziju \"Dušan Vasiljev\" u Kikindi. Ovaj sajt je rađen kao projekat za kurs iz Praktikuma PHP na visokoj ICT!");

// Save document
// $filename = tempnam(sys_get_temp_dir(), "word");
$word->Documents[1]->SaveAs("autor".time().".docx");
$word->Documents[1]->Save();
// $radniDeo->SaveAs("autor.docx");
// $radniDeo->Save();

// Close and quit
// $word->quit();
// unset($word);
// header("Content-type: application/vnd.ms-word");
// header("Content-Disposition: attachment;Filename=document_name.docx");
header("Location:../../views/pages/edit.php");
