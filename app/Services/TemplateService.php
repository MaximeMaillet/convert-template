<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;

class TemplateService
{
    public function getAll()
    {
        $root = $this;
        return array_map(
            static function ($item) use ($root) {
                return $root->getFilenameFromPath($item);
            },
            Storage::files('templates')
        );
    }

    public function getFilenameFromPath($item)
    {
        $filename = substr($item, strrpos($item, '/')+1);
        return substr($item, strrpos($item, '/')+1, strlen($filename)-5);
    }

    public function getFullPathFromFilename($filename): string
    {
        return 'templates/'.$filename.'.twig';
    }
}
