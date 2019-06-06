<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;

class TemplateForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', Field::TEXT, [
                'rules' => 'required'
            ])
            ->add('template', Field::TEXTAREA, [
                'rules' => 'required'
            ])
            ->add('submit', Field::BUTTON_SUBMIT)
        ;
    }
}
