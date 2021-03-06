<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator {

    protected $rules = [
        'name' => 'required',
        'file' => 'required',
        'description' => 'required',
        'project_id' => 'required|integer|exists:projects,id',
    ];
} 