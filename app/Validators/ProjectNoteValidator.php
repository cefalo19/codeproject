<?php

namespace CodeProject\Validators;

use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator {

    protected $rules = [
        'client_id' => 'required|integer',
        'title' => 'required',
        'note' => 'required'
    ];
} 