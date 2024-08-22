<?php

namespace App\Exports;

// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use App\Models\Basic;

class CostSheetExport implements FromArray,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(array $data)

    {
        $this->data = $data;
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

                $event->sheet->mergeCells('C2:D2');
                $event->sheet->mergeCells('F2:G2');
                $event->sheet->mergeCells('I2:J2');
                $event->sheet->mergeCells('L2:M2');
                $event->sheet->mergeCells('O2:P2');
                $event->sheet->mergeCells('R2:S2');
                $event->sheet->mergeCells('U2:V2');
                $event->sheet->mergeCells('Y2:Z2');

                $event->sheet->mergeCells('C3:D3');
                $event->sheet->mergeCells('F3:G3');
                $event->sheet->mergeCells('I3:J3');
                $event->sheet->mergeCells('L3:M3');
                $event->sheet->mergeCells('O3:P3');
                $event->sheet->mergeCells('R3:S3');
                $event->sheet->mergeCells('U3:V3');
                $event->sheet->mergeCells('Y3:Z3');
                $event->sheet->mergeCells('C4:D4');
                $event->sheet->mergeCells('F4:G4');
                $event->sheet->mergeCells('I4:J4');
                $event->sheet->mergeCells('L4:M4');
                $event->sheet->mergeCells('O4:P4');
                $event->sheet->mergeCells('R4:S4');
                $event->sheet->mergeCells('U4:V4');
                $event->sheet->mergeCells('Y4:Z4');
                $event->sheet->mergeCells('C5:D5');
                $event->sheet->mergeCells('F5:G5');
                $event->sheet->mergeCells('I5:J5');
                $event->sheet->mergeCells('L5:M5');
                $event->sheet->mergeCells('O5:P5');
                $event->sheet->mergeCells('R5:S5');
                $event->sheet->mergeCells('U5:V5');
                $event->sheet->mergeCells('Y5:Z5');
                // $event->sheet->setCellValue('A1','COST SHEET');

                // $event->sheet->mergeCells('A2:B2');
                // $event->sheet->setCellValue('A2','Product Name');
                // $event->sheet->mergeCells('A3:B3');
                // $event->sheet->setCellValue('A3','Version');
                // $event->sheet->mergeCells('A4:B4');
                // $event->sheet->setCellValue('A4','Launch Qty');
                // $event->sheet->mergeCells('A5:B5');
                // $event->sheet->setCellValue('A5','Location');
                // $event->sheet->mergeCells('A6:B6');
                // $event->sheet->setCellValue('A6','Specific Gravity');
                // $event->sheet->mergeCells('A7:B7');
                // $event->sheet->setCellValue('A7','Fill Volume (ml or grams)');

                // $event->sheet->mergeCells('A8:B8');

                $event->sheet->getDelegate()->getStyle('A1:A200')->getFont()->setBold(true)->setSize(11);
                $event->sheet->getDelegate()->getStyle('A1:Z1')->getFont()->setBold(true)->setSize(11);
                $event->sheet->getDelegate()->getStyle('B1')->getFont()->setBold(true)->setSize(11);

                $event->sheet->getDelegate()->getStyle('C3')->getFont()->setBold(true)->setSize(11);
                $event->sheet->getDelegate()->getStyle('F3')->getFont()->setBold(true)->setSize(11);
                $event->sheet->getDelegate()->getStyle('I3')->getFont()->setBold(true)->setSize(11);
                $event->sheet->getDelegate()->getStyle('L3')->getFont()->setBold(true)->setSize(11);
                $event->sheet->getDelegate()->getStyle('O3')->getFont()->setBold(true)->setSize(11);
                $event->sheet->getDelegate()->getStyle('R3')->getFont()->setBold(true)->setSize(11);
                $event->sheet->getDelegate()->getStyle('U3')->getFont()->setBold(true)->setSize(11);
                // $event->sheet->getDelegate()->getStyle('C2:C7')->getFont()->setBold(true)->setSize(11);
                // $event->sheet->getDelegate()->getStyle('A10:A34')->getFont()->setBold(true)->setSize(11);
                // $event->sheet->getDelegate()->getStyle('B10:B34')->getFont()->setBold(true)->setSize(11);


                //column  text alignment
                $styleArray2 = array(
                    'alignment' => array(
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        )
                );


                $styleArray5 = array(
                    'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,

                    'startColor' => [
                        'argb' => 'E0E0E0',
                        // 'argb' => 'ebd9427a',//pink color

                    ]]);


                // $event ->sheet->getStyle('A1:D1')->applyFromArray($styleArray5);
                // $event ->sheet->getStyle('A9:D9')->applyFromArray($styleArray5);


            },
        ];
    }


}
