<?php

namespace App\Http\Requests\Admin\Role;

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
            'menus' => 'required|array',
            'menus.*.id' => 'required|integer|exists:menu,id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => '角色名',
            'menus' => '菜单',
            'menus.*.id' => '菜单项',
        ];
    }
}
