<?php

namespace App\Macros;

use Illuminate\Support\Str;
use App\Services\ImagekitService;
// use App\Services\ImagekitService;

class StringMacros
{
    public function bytesToHuman()
    {
        return function ($bytes) {
            $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];

            for ($i = 0; $bytes > 1024; $i++) {
                $bytes /= 1024;
            }

            return round((float) number_format($bytes, 2)) . ' ' . $units[$i];
        };
    }

    public function readDuration()
    {
        return function (...$text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);

            return (int)max(1, $minutesToRead);
        };
    }

    public function customMarkdown()
    {
        return function ($markdown) {
            $config = [
                'heading_permalink' => [
                    'html_class' => 'heading-permalink mr-1 no-underline text-gray-400',
                    'id_prefix' => '',
                    'fragment_prefix' => '',
                    'insert' => 'before',
                    'min_heading_level' => 1,
                    'max_heading_level' => 6,
                    'title' => 'Permalink',
                    'symbol' => '#',
                    'aria_hidden' => true,
                ],
                'table' => [
                    'wrap' => [
                        'enabled' => false,
                        'tag' => 'div',
                        'attributes' => [],
                    ],
                ],
            ];
    
            $environment = new Environment($config);
            $environment->addExtension(new CommonMarkCoreExtension());
    
            $environment->addExtension(new HeadingPermalinkExtension());
            $environment->addExtension(new TableOfContentsExtension());
            $environment->addExtension(new TableExtension());
    
            $converter = new MarkdownConverter($environment);
         
            return $converter->convert($markdown);
        };
    }

    public function greet()
    {
        return function (string $name) {
            $hour = (int) now()->setTimezone('Asia/Kolkata')->format('H');
            
            if ($hour >= 18) {
                return "Good Evening, " . explode(' ', $name)[0];
            } elseif ($hour >= 12) {
                return "Good Afternoon, " . explode(' ', $name)[0];
            } elseif ($hour < 12) {
                return "Good Morning, " . explode(' ', $name)[0];
            } else {
                return "Welcome back, " . explode(' ', $name)[0];
            }
        };
    }

    public function generateLink()
    {
        return function (string $link = '#', string $linkText) {
            return sprintf("<a href='%s' class='text-sky-600 inline-block hover:underline decoration-sky-200'>%s</a>", $link, str()->headline($linkText));
        };
    }

    public function generateHeading()
    {
        return function (string $text) {
            return sprintf("<h2 class='text-gray-700 font-medium'>%s</h2>", str()->headline($text));
        };
    }

    public function generateSubHeading()
    {
        return function (string $text) {
            return sprintf("<p class='text-gray-500 text-sm'>%s</p>", $text);
        };
    }

    public function numberToWords()
    {
        return function ($value) {
            if (! is_numeric($value)) {
                return false;
            }
    
            $explodeCurrency = explode('.', floatval(str_replace(',', '', $value)));
    
            $f = new \NumberFormatter("en_IN", \NumberFormatter::SPELLOUT);
    
            if (count($explodeCurrency) === 2) {
                return Str::title(sprintf(
                    "%s Rupee and %s Paisa Only",
                    $f->formatCurrency($explodeCurrency[0], "INR"),
                    $f->formatCurrency($explodeCurrency[1], "INR")
                ));
            } else {
                return Str::title(sprintf(
                    "%s Rupee Only",
                    $f->formatCurrency($explodeCurrency[0], "INR")
                ));
            }
        };
    }

    public function money()
    {
        return function (float|int|string $expression) {
            $formatter = new \NumberFormatter('en_IN', \NumberFormatter::CURRENCY);
            return $formatter->format($expression);
        };
    }

    public function generateImageKitUrl()
    {
        return function (string $image = null, array $transformation = [], string $type = null) {
            if (is_null($image)) {
                return '';
            }
    
            $imagekitService = ImagekitService::make()
                ->forImage($image)
                ->addTransformation($transformation);
            
            return $type === 'webproxy' ? $imagekitService->generateImageUrl() : $imagekitService->generateUrl();
        };
    }
}