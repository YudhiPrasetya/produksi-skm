<?php
    // memanggil fungsi autoload.php
    require 'vendor/autoload.php';

    // load phpspreedsheet menggunakan namespace
    use PhpOffice\PhpSpreadsheet\Spreadsheet;

    //call ioFactory of xlsx
    use PhpOffice\PhpSpreadsheet\IOFactory;    

    //buat object excel spreedsheet
    $spreadsheet = new Spreadsheet();

    // get current active sheet
    $sheet = $spreadsheet->getActiveSheet();
    // set the value of cell a1 to hellowordl
    $sheet->setCellValue('A1', 'HELLO WORLD !' );

    // set the header first , so the result will be treated as an xlsx file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    //make it an attachment so we can define filename
    header('Content-Disposition: attachment; filename="result.xlsx"');

    //Create IOFACTORY Object
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    //saveInto php output
    $writer->save('php://output');


    
?>