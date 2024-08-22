<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class EPDCostSheetExport implements FromArray,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
    }

    public function __construct(array $data,string $prmcount)
    {
        $this->data = $data;
        $this->count = $prmcount;
    }

    public function array(): array
    {
        return $this->data;
    }


     /**
     * Write code on Method
     *
     * @return response()
     */
    public function registerEvents(): array
    {

        // $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');

        return [
            AfterSheet::class    => function(AfterSheet $event) {
                    
                $columnCount = ($this->count)+1; // Assuming $this->count contains the column count
                $mergeRange = 'A1:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount) . '1';
    
                $event->sheet->mergeCells($mergeRange);
                // $event->sheet->mergeCells('A1:B1');
                $event->sheet->setCellValue('A1','CavinKare Pvt Ltd'); 

                $event->sheet->mergeCells('A2:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount) . '2');
                $event->sheet->setCellValue('A2','Tentative Cost sheet'); 

                $event->sheet->mergeCells('A3:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount) . '3');
                // $event->sheet->setCellValue('A3','Material Code'); 

                $event->sheet->mergeCells('A4:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount) . '4');
                // $event->sheet->setCellValue('A4','Plant'); 

                $event->sheet->mergeCells('A5:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount) . '5');


                $event->sheet->getDelegate()->getStyle('A1')->getFont()->setBold(true)->setSize(14);
                $event->sheet->getDelegate()->getStyle('A2')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle('A3')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle('A4')->getFont()->setBold(true)->setSize(13);

                $event->sheet->getDelegate()->getStyle('B1:B4')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getDelegate()->getStyle('A6:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount) . '6')->getFont()->setBold(true)->setSize(13);
                // $event->sheet->getDelegate()->getStyle('A7:A40')->getFont()->setBold(true)->setSize(11);
                // $event->sheet->getDelegate()->getStyle('B7:B40')->getFont()->setBold(true)->setSize(11);


                //column  text alignment
                $styleArray2 = array(
                    'alignment' => array(
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        )
                );		

				$event ->sheet->getStyle('A1')->applyFromArray($styleArray2);
				$event ->sheet->getStyle('A2')->applyFromArray($styleArray2);
				$event ->sheet->getStyle('A3')->applyFromArray($styleArray2);
				$event ->sheet->getStyle('A4')->applyFromArray($styleArray2);

                $styleArray5 = array(
                    'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    
                    'startColor' => [
                        'argb' => 'E0E0E0',
                        // 'argb' => 'ebd9427a',//pink color
        
                    ]]);
               
                    
                $event->sheet->getStyle($mergeRange)->applyFromArray($styleArray5);
                // $event ->sheet->getStyle('A1:B1')->applyFromArray($styleArray5);

                $event ->sheet->getStyle('A6:' . \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount) . '6')->applyFromArray($styleArray5);


                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        //'color' => ['argb' => 'FFFF0000'],
                            ],
                        ],
                    ];	
                // $event->sheet->getStyle('A6:B6')->ApplyFromArray($styleArray);
                $event->sheet->getStyle($mergeRange)->applyFromArray($styleArray);
                // $event->sheet->cells('A1:C1', function($cells) {
                //     $cells->setBorder('thin', 'thin', 'thin', 'thin');
                // });
                // $event->sheet->mergeCells('A1:C1');

                
                // Set the width of a particular column
                // // Set the same width for all columns (e.g., 25)
                // $width = 25;
                // // Get the highest column letter
                // $highestColumn = $event->sheet->getDelegate()->getHighestColumn();
                // // Loop through each column and set the width
                // for ($col = 'B'; $col <= $highestColumn; $col++) {
                //     $event->sheet->getDelegate()->getColumnDimension($col)->setWidth($width);
                // }
             

                // Define the row number where you want to apply word wrap
                $rowNumber = 8;
                $width = 25;
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(40);
                // Get the highest column number
                $highestColumn = $event->sheet->getDelegate()->getHighestColumn();
                // Loop through each column in the specified row and set word wrap & width
                for ($col = 'A'; $col <= $highestColumn; $col++) {
                    //width & text center
                    if($col !='A'){
                        // text center columns...
                        $event->sheet->getStyle($col . '6:' . $col . '47')->applyFromArray($styleArray2);

                        $event->sheet->getDelegate()->getColumnDimension($col)->setWidth($width);
                    }
                    //word wrap
                    $cellCoordinate = $col . $rowNumber;
                    $event->sheet->getStyle($cellCoordinate)->getAlignment()->setWrapText(true);
                }

            },
        ];
    }

}
