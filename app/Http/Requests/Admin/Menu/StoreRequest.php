<?php

namespace App\Http\Requests\Admin\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:60',
            'permissions' => 'nullable|array',
            'permissions.*.id' => 'nullable|integer|exists:permission,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '菜单名',
            'permissions' => '路由',
            'permissions.*.id' => '路由项',
        ];
    }
}
