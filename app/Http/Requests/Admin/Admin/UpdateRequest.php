<?php

namespace App\Http\Requests\Admin\Admin;

use App\Models\AdminModel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return AdminModel::query()->where($this->route('id'))->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => [
                'required',
                'string',
                Password::min(8)->letters()->numbers()->mixedCase(),
            ],
        ];
    }
}
