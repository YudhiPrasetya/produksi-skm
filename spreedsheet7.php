<?php
    // memanggil fungsi autoload.php
    require 'vendor/autoload.php';

    // load phpspreedsheet menggunakan namespace
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    //call ioFactory of xlsx
    use PhpOffice\PhpSpreadsheet\Style\Alignment;    
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    IOFactory::createReader()

    //styling arrays
    //table head style
    $tableHead = [
        'font'=>[
            'color'=>[
                'rgb'=>'FFFFFF'
            ],
            'bold'=>true,
            'size'=>11
        ],
        'fill'=>[
            'fillType' => FILL::FILL_SOLID,
            'startColor' => [
                'rgb' => '538ED5'
            ]
        ]
    ];

    //even row
    $evenRow = [
        'fill'=>[
            'fillType' => FILL::FILL_SOLID,
            'startColor' => [
                'rgb' => '00BDFF'
            ]
        ]
    ];

    $oddRow = [
        'fill'=>[
            'fillType' => FILL::FILL_SOLID,
            'startColor' => [
                'rgb' => '00EAFF'
            ]
        ]
    ];
    
    //make a new spreedsheet objek
    $spreadsheet = new Spreadsheet();
    //get current active sheet
    $sheet = $spreadsheet->getActiveSheet();

    $spreadsheet->getDefaultStyle()
        ->getFont()
        ->setName('Arial')
        ->setSize(10);

    //heading
    $spreadsheet->getActiveSheet()
        ->setCellValue('A1', "Participant Student");
    
    //merge heading
    $spreadsheet->getActiveSheet()
        ->mergeCells("A1:F1");
    
    //set font style
    $spreadsheet->getActiveSheet()
        ->getStyle('A1')
        ->getFont()->setSize(20);

    //set cell alignment
    $spreadsheet->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(ALIGNMENT::HORIZONTAL_CENTER);

    //setting coloumn width 
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(12);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);

    //set value
    $spreadsheet->getActiveSheet()
        ->setCellValue('A2',"ID")
        ->setCellValue('B2',"First Name")
        ->setCellValue('C2',"Last Name")
        ->setCellValue('D2',"Email")
        ->setCellValue('E2',"Gander")
        ->setCellValue('F2',"Class"); 

    // //set font style
    // $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFont()->getSize(11);
    // $spreadsheet->getActiveSheet()->getStyle('A2:F2')->getFont()->setBold(true);

    //background color
    $spreadsheet->getActiveSheet()->getStyle('A2:F2')->applyFromArray($tableHead);

    // the content
    //read the json file
    $file = file_get_contents('student-data.json');
    $studentData = json_decode($file, true);

    //LOOP trough the data 
    //current row
    $row = 3;
    foreach($studentData as $student){
        $spreadsheet->getActiveSheet()
            ->setCellValue('A'.$row, $student['id'])
            ->setCellValue('B'.$row, $student['first_name'])
            ->setCellValue('C'.$row, $student['last_name'])
            ->setCellValue('D'.$row, $student['email'])
            ->setCellValue('E'.$row, $student['gender'])
            ->setCellValue('F'.$row, $student['class']);


    // set row style
    if( $row % 2 == 0 ){
        // even row
        $spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($evenRow);
    }else{
        // odd row
        $spreadsheet->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($oddRow);
    }
        //increment row
        $row++;
    }

    //autofilter
    //define first row and last row
    $firstRow = 2;
    $lastRow = $row-1;

    $spreadsheet->getActiveSheet()->setAutoFilter("A".$firstRow.":F".$lastRow);


    // set the header first , so the result will be treated as an xlsx file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    //make it an attachment so we can define filename
    header('Content-Disposition: attachment; filename="result.xlsx"');

    //Create IOFACTORY Object
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    //saveInto php output
    $writer->save('php://output');


    
?>