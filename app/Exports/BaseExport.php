<?php


namespace App\Exports;


use Carbon\Carbon;
use Carbon\Traits\Creator;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BaseExport implements WithStyles
{
    /**
     * Aplica formatação de estilo na planilha
     *
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        $largura = $sheet->getHighestColumn();
        $altura = $sheet->getHighestRow();

        // Formatar cor de fundo linhas ímpares
        for ($i=1; $i<=$altura; $i++){
            $cell = 'A'.$i.':'.$largura.$i;
            if($i%2 == 1){
                $sheet->getStyle($cell)
                    ->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFFAFAFA');
            }
        }

        // Aplicar bordas
        $sheet->getStyle('A1:'.$largura.$altura)->getBorders()
            ->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Aplica estilo do cabeçalho
        $style = [
            'font' => [
                'bold' => true,
                'size' => '12',
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFDDDDDD',
                ],
            ],
        ];

        $sheet->getStyle('A1:'.$largura.'2')->applyFromArray($style);
        $style_titulo = $sheet->mergeCells('A1:'.$largura.'1')->getStyle('A1:'.$largura.'1');
        $style_titulo->getFont()->setSize('13');
        $style_titulo->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    }

    /**
     * Formata a data para o tipo compreendido pela planilha ou retorna null caso a data seja inválida
     *
     * @param $date
     * @return float|int|null
     * @throws \Exception
     */
    public function dateOrNull($date)
    {
        return ($date) ? Date::dateTimeToExcel(new Carbon($date)) : null;
    }
}

