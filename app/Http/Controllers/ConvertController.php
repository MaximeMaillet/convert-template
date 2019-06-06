<?php

namespace App\Http\Controllers;

use App\Forms\ConvertForm;
use App\Services\ConvertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Kris\LaravelFormBuilder\FormBuilder;

class ConvertController extends Controller
{
    /**
     * @var ConvertService
     */
    protected $convertService;

    public function __construct(ConvertService $convertService)
    {
        $this->convertService = $convertService;
    }

    public function make(Request $request, FormBuilder $formBuilder)
    {
        $convertForm = $formBuilder->create(ConvertForm::class, [
            'method' => 'POST',
            'url' => route('convert.make'),
            'model' => [
                'data' => '{"products":[{"name": "bm", "price":400, "description": "cool"}, {"name": "merco", "price":5000, "description": "top cool"}]}'
            ]
        ]);

        $resultTemplate = null;
        if ($request->isMethod('post') && $convertForm->isValid()) {
            $resultTemplate = $this->convertService->convert($request->get('template'), $request->get('data'));
        }

        return View::make('converts/make', [
            'form' => $convertForm,
            'resultTemplate' => $resultTemplate,
        ]);
    }
}
