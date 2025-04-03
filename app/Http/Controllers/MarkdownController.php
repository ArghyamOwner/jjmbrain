<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class MarkdownController extends Controller
{
    public function show($file)
    {
        $html = cache()->rememberForever($file, function () use ($file) {
            $filePath = resource_path('markdown/'.$file.'.md');
            $markdown = file_get_contents($filePath);
            return Blade::render(Str::markdown($markdown));
        });

        return view('markdown', ['content' => $html]);
    }
}
