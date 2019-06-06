<?php

namespace App\Http\Controllers;

use App\Forms\ConvertForm;
use App\Forms\TemplateForm;
use App\Services\TemplateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Kris\LaravelFormBuilder\FormBuilder;

class TemplateController extends Controller
{
    /**
     * @var TemplateService
     */
    protected $templateService;

    /**
     * TemplateController constructor.
     * @param TemplateService $templateService
     */
    public function __construct(TemplateService $templateService)
    {
        $this->templateService= $templateService;
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function list()
    {
        return View::make('templates/list', [
            'templates' => $this->templateService->getAll(),
        ]);
    }

    /**
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Request $request, FormBuilder $formBuilder): \Illuminate\Contracts\View\View
    {
        $templateForm = $formBuilder->create(TemplateForm::class, [
            'method' => 'POST',
            'url' => route('template.create'),
        ]);

        if ($request->isMethod('post') && $templateForm->isValid()) {
            Storage::disk('templates')->put($request->get('name').'.twig', $request->get('template'));
        }

        return View::make('templates/create', [
            'form' => $templateForm,
        ]);
    }

    /**
     * @param $name
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($name, Request $request, FormBuilder $formBuilder)
    {
        $templates = Storage::files('templates');
        $template = null;
        foreach ($templates as $template) {
            if ($this->templateService->getFilenameFromPath($template) === $name) {
                break;
            }
        }

        $templateForm = $formBuilder->create(TemplateForm::class, [
            'method' => 'POST',
            'url' => route('template.edit', ['name' => $name]),
            'model' => [
                'name' => $this->templateService->getFilenameFromPath($template),
                'template' => Storage::get($template)
            ]
        ]);

        if ($request->isMethod('post') && $templateForm->isValid()) {
            Storage::disk('templates')->put($request->get('name').'.twig', $request->get('template'));
            $templateForm->setModel([
                'name' => $this->templateService->getFilenameFromPath($template),
                'template' => Storage::get($template)
            ]);
        }

        return View::make('templates/edit', [
            'form' => $templateForm,
        ]);
    }
}
