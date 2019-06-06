<?php

namespace App\Forms;

use App\Services\TemplateService;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class ConvertForm extends Form
{
    /**
     * @var TemplateService
     */
    protected $templateService;

    public function __construct(TemplateService $templateService)
    {
        $this->templateService = $templateService;
    }

    public function buildForm()
    {
        $choices = [];
        $templates = $this->templateService->getAll();
        foreach ($templates as $template) {
            $choices[$this->templateService->getFullPathFromFilename($template)] = $template;
        }
        $this
            ->add('template', Field::SELECT, [
                'choices' => $choices,
            ])
            ->add('data', Field::TEXTAREA, [
                'rules' => 'max:5000'
            ])
            ->add('submit', Field::BUTTON_SUBMIT)
        ;
    }
}
