<?php

require 'vendor/autoload.php';
include 'connect.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

/* =========================================
   SEARCH CUSTOMER
========================================= */

$search = "";

if (isset($_GET['search'])) {

    $search = mysqli_real_escape_string(
        $db_con,
        $_GET['search']
    );

}


/* =========================================
   CUSTOMER QUERY
========================================= */

if ($search != "") {

    $sql = mysqli_query(
        $db_con,
        "SELECT * FROM customer
         WHERE name LIKE '%$search%'
         OR address LIKE '%$search%'
         OR age LIKE '%$search%'
         OR balance LIKE '%$search%'
         ORDER BY id ASC"
    );

} else {

    $sql = mysqli_query(
        $db_con,
        "SELECT * FROM customer
         ORDER BY id ASC"
    );

}


/* =========================================
   CREATE EXCEL WORKBOOK
========================================= */

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->setTitle('Customers');


/* =========================================
   REPORT TITLE
========================================= */

$sheet->mergeCells('A1:F1');

$sheet->setCellValue(
    'A1',
    'ZENITHBANK BANKING MANAGEMENT SYSTEM'
);

$sheet->mergeCells('A2:F2');

$sheet->setCellValue(
    'A2',
    'CUSTOMER RECORDS REPORT'
);

$sheet->mergeCells('A3:F3');

$sheet->setCellValue(
    'A3',
    'Generated: ' . date('d F Y, h:i A')
);


/* =========================================
   SEARCH INFORMATION
========================================= */

if ($search != "") {

    $sheet->mergeCells('A4:F4');

    $sheet->setCellValue(
        'A4',
        'Search Filter: ' . $search
    );

    $headerRow = 6;

} else {

    $headerRow = 5;

}


/* =========================================
   TABLE HEADERS
========================================= */

$sheet->setCellValue(
    'A' . $headerRow,
    'S/N'
);

$sheet->setCellValue(
    'B' . $headerRow,
    'Customer ID'
);

$sheet->setCellValue(
    'C' . $headerRow,
    'Customer Name'
);

$sheet->setCellValue(
    'D' . $headerRow,
    'Age'
);

$sheet->setCellValue(
    'E' . $headerRow,
    'Address'
);

$sheet->setCellValue(
    'F' . $headerRow,
    'Account Balance'
);


/* =========================================
   INSERT CUSTOMER DATA
========================================= */

$rowNumber = $headerRow + 1;

$counter = 1;

$totalBalance = 0;

while ($row = mysqli_fetch_assoc($sql)) {

    $sheet->setCellValue(
        'A' . $rowNumber,
        $counter
    );

    $sheet->setCellValue(
        'B' . $rowNumber,
        $row['id']
    );

    $sheet->setCellValue(
        'C' . $rowNumber,
        $row['name']
    );

    $sheet->setCellValue(
        'D' . $rowNumber,
        $row['age']
    );

    $sheet->setCellValue(
        'E' . $rowNumber,
        $row['address']
    );

    $sheet->setCellValue(
        'F' . $rowNumber,
        (float)$row['balance']
    );

    $totalBalance += (float)$row['balance'];

    $rowNumber++;

    $counter++;

}


/* =========================================
   TOTAL ROW
========================================= */

$totalRow = $rowNumber;

$sheet->mergeCells(
    'A' . $totalRow . ':E' . $totalRow
);

$sheet->setCellValue(
    'A' . $totalRow,
    'TOTAL CUSTOMER BALANCE'
);

$sheet->setCellValue(
    'F' . $totalRow,
    $totalBalance
);


/* =========================================
   TITLE STYLING
========================================= */

$sheet->getStyle('A1:F1')->applyFromArray([

    'font' => [
        'bold' => true,
        'size' => 16
    ],

    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]

]);


$sheet->getStyle('A2:F2')->applyFromArray([

    'font' => [
        'bold' => true,
        'size' => 13
    ],

    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]

]);


$sheet->getStyle('A3:F3')->applyFromArray([

    'font' => [
        'italic' => true,
        'size' => 10
    ],

    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER
    ]

]);


/* =========================================
   SEARCH STYLE
========================================= */

if ($search != "") {

    $sheet->getStyle('A4:F4')->applyFromArray([

        'font' => [
            'italic' => true,
            'bold' => true
        ],

        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER
        ]

    ]);

}


/* =========================================
   HEADER STYLE
========================================= */

$sheet->getStyle(
    'A' . $headerRow . ':F' . $headerRow
)->applyFromArray([

    'font' => [
        'bold' => true
    ],

    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],

    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'color' => [
            'rgb' => 'D9EAF7'
        ]
    ],

    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN
        ]
    ]

]);


/* =========================================
   DATA BORDER
========================================= */

if ($totalRow > $headerRow + 1) {

    $sheet->getStyle(
        'A' . $headerRow . ':F' . ($totalRow - 1)
    )->applyFromArray([

        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN
            ]
        ]

    ]);

}


/* =========================================
   TOTAL ROW STYLE
========================================= */

$sheet->getStyle(
    'A' . $totalRow . ':F' . $totalRow
)->applyFromArray([

    'font' => [
        'bold' => true
    ],

    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN
        ]
    ],

    'alignment' => [
        'vertical' => Alignment::VERTICAL_CENTER
    ]

]);


/* =========================================
   CURRENCY FORMAT
========================================= */

if ($totalRow > $headerRow + 1) {

    $sheet->getStyle(
        'F' . ($headerRow + 1) . ':F' . $totalRow
    )->getNumberFormat()
     ->setFormatCode(
         '"₦"#,##0.00'
     );

}


/* =========================================
   ALIGNMENT
========================================= */

$sheet->getStyle(
    'A' . ($headerRow + 1) . ':B' . $totalRow
)->getAlignment()->setHorizontal(
    Alignment::HORIZONTAL_CENTER
);

$sheet->getStyle(
    'D' . ($headerRow + 1) . ':D' . $totalRow
)->getAlignment()->setHorizontal(
    Alignment::HORIZONTAL_CENTER
);


/* =========================================
   AUTO COLUMN WIDTH
========================================= */

foreach (range('A', 'F') as $column) {

    $sheet->getColumnDimension($column)
          ->setAutoSize(true);

}


/* =========================================
   EXTRA WIDTH FOR ADDRESS
========================================= */

$sheet->getColumnDimension('E')
      ->setWidth(30);


/* =========================================
   ROW HEIGHT
========================================= */

$sheet->getRowDimension(1)->setRowHeight(25);

$sheet->getRowDimension(2)->setRowHeight(22);


/* =========================================
   FILTER
========================================= */

$sheet->setAutoFilter(
    'A' . $headerRow . ':F' . ($totalRow - 1)
);


/* =========================================
   FREEZE HEADER
========================================= */

$sheet->freezePane(
    'A' . ($headerRow + 1)
);


/* =========================================
   PAGE SETUP
========================================= */

$sheet->getPageSetup()
      ->setOrientation(
          \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE
      );

$sheet->getPageSetup()
      ->setFitToWidth(1);

$sheet->getPageSetup()
      ->setFitToHeight(0);


/* =========================================
   DOWNLOAD EXCEL FILE
========================================= */

$filename = 'customer_records_' . date('Y-m-d_H-i-s') . '.xlsx';

header(
    'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);

header(
    'Content-Disposition: attachment;filename="' . $filename . '"'
);

header(
    'Cache-Control: max-age=0'
);


/* =========================================
   WRITE FILE
========================================= */

$writer = new Xlsx($spreadsheet);

$writer->save('php://output');

exit;

?>