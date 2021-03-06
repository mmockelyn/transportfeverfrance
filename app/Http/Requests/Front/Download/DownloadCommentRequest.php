<?php

namespace App\Http\Requests\Front\Download;

use Illuminate\Foundation\Http\FormRequest;

class DownloadCommentRequest extends FormRequest
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
            "message" => "required|max:1000"
        ];
    }
}
