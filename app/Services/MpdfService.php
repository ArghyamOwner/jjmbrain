<?php

namespace App\Services;

use Mpdf\Mpdf;
use Mpdf\Output\Destination;

/*
Example 1
$mpdf = MpdfService::make()->getMpdf();
$mpdf->SetWatermarkText('test');
$mpdf->showWatermarkText = true;
$mpdf->WriteHTML($pdf);
return $mpdf->Output('test.pdf', Destination::INLINE);

Example 2
return MpdfService::make($pdf)->addWatermarkText('invoice')->stream();
*/

class MpdfService
{
    protected $mpdf;

    public function __construct(
        public ?string $view = null,
        public array $options = [],
        public string $filename = 'download.pdf'
    ) {
        $this->mpdf = new Mpdf(array_merge([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'hind',
            'margin_footer' => '10',
            'margin_top' => '10',
            'margin_bottom' => '20',
            'fontDir' => public_path('fonts/'),
            'tempDir' => base_path('storage/app/mpdf'),
            'fontdata' => [
                'hind' => [
                    'R'  => 'timesnewroman.ttf',
                    'B'  => 'timesnewroman-bold.ttf',
                ]
            ]
          ], $options));
    }

    public static function make(string $view = null, array $options = [], string $filename = 'download.pdf')
    {
        return new static($view, $options, $filename);
    }

    public function getMpdf()
    {
        return $this->mpdf;
    }

    public function addWatermarkText(string $text = 'Watermark', $alpha = 0.1)
    {
        $this->mpdf->SetWatermarkText($text);
        $this->mpdf->showWatermarkText = true;
        $this->mpdf->watermarkTextAlpha = $alpha;

        return $this;
    }

    public function stream($filename = null)
    {
        $this->writeHtml();
      
        return $this->mpdf->Output($filename ?? $this->filename, Destination::INLINE);
    }

    public function download($filename = null)
    {
        $this->writeHtml();
      
        return $this->mpdf->Output($filename ?? $this->filename, Destination::DOWNLOAD);
    }

    protected function writeHtml()
    {
        $this->mpdf->WriteHTML($this->view);
        
        return $this;
    }
}
