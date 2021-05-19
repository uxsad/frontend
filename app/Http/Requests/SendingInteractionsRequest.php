<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendingInteractionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "data.*.keyboard.*" => 'present|string',
            "data.*.mouse.buttons.*" => 'present|numeric',
            "data.*.mouse.position.x" => 'required|numeric',
            "data.*.mouse.position.y" => 'required|numeric',
            'data.*.scroll.absolute.x' => 'required|numeric',
            'data.*.scroll.absolute.y' => 'required|numeric',
            'data.*.scroll.relative.x' => 'required|numeric',
            'data.*.scroll.relative.y' => 'required|numeric',
            "data.*.timestamp" => 'required|numeric',
            "data.*.url" => "required|url",
            "data.*.window.screen.x" => 'required|numeric',
            "data.*.window.screen.y" => 'required|numeric',
            "data.*.window.document.x" => 'required|numeric',
            "data.*.window.document.y" => 'required|numeric',
            "data.*.userId" => "required|string",
            "data.*.websiteId" => 'required|numeric',
            "data.*.pageTitle" => 'required|string',
        ];
    }
}
