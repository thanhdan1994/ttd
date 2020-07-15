<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait File
{
    protected function create($filename, $content, $disk = 'local')
    {
        Storage::disk($disk)->put($filename, $content);
    }
}
