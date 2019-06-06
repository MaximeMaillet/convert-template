<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use TwigBridge\Facade\Twig;

class ConvertService
{
    public const TEMPLATE_COLLECTION = 'CollectionTemplate';

    protected const PATTERN_COLLECTION = '/\[\[CollectionTemplate::(.+)\((.+)\)\]\]/';

    public function convert($template, $data): string
    {
        $data = json_decode($data, 1);
        $template = Twig::createTemplate(Storage::get($template));
        $render = Twig::render($template, $data);

        $isCollectionMatch = preg_match(self::PATTERN_COLLECTION, $render, $matches);
        if($isCollectionMatch) {
            $overrideTemplate = $this->handleTemplateCollection($matches[1], $data[$matches[2]]);
            $render = preg_replace(self::PATTERN_COLLECTION, $overrideTemplate, $render);
        }

        return $render;
    }

    protected function handleTemplateCollection($filename, $data): string
    {
        $templateContent = Storage::get('templates/'.$filename.'.twig');
        $overrideTemplate = '{% for item in array %}'.preg_replace('/\{\{\s(.+)\s\}\}/', '{{ item.$1 }}', $templateContent).'{% endfor %}';
        $template= Twig::createTemplate($overrideTemplate);
        return Twig::render($template, [
            'array' => $data
        ]);
    }
}
