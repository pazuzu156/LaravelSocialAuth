<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class BaseRequest extends FormRequest
{
    /**
     * {@inheritdoc}
     */
    protected function createDefaultValidator(ValidationFactory $factory)
    {
        session()->flash('emsg', 'Invalid form submission');

        return parent::createDefaultValidator($factory);
    }
}
