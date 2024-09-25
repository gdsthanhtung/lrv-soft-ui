<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Config;

class RoleRequest extends FormRequest
{
    private $table = 'roles';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [];
        $id = $this->id;
        $task = $this->task;
        $avatar = $this->avatar;

        $ruleSelectStatus = array_keys(Config::get('gds.enum.selectStatus'));
        $ruleSelectLevel = array_keys(Config::get('gds.enum.selectLevel')['value']);

        $condName       = '';
        $condAvatar     = '';
        $condEmail      = '';
        $condPass       = '';
        $condLevel      = '';
        $condStatus     = '';

        switch ($task) {
            case 'add':
                $condEmail      = ['bail','required','email',Rule::unique($this->table,'email')];
                $condPass       = ['bail','required','between:5,100','confirmed'];
                $condName       = ['bail','required','min:5'];
                $condStatus     = ['bail',Rule::in($ruleSelectStatus)];
                $condLevel      = ['bail',Rule::in($ruleSelectLevel)];
                $condAvatar     = ['bail','required','image','max:500'];
                break;

            case 'edit':
                $condEmail      = ['bail','required','email',Rule::unique($this->table,'email')->ignore($id)];
                $condName       = ['bail','required','min:5'];
                $condStatus     = ['bail',Rule::in($ruleSelectStatus)];
                $condLevel      = ['bail',Rule::in($ruleSelectLevel)];
                $condAvatar     = ($avatar) ? ['bail','image','max:500'] : '';
                break;

            case 'change-password':
                $condPass       = ['bail','required','between:5,100','confirmed'];
                break;

            default:
                break;
        }

        return [
            'email'     => $condEmail,
            'password'  => $condPass,
            'name'      => $condName,
            'status'    => $condStatus,
            'level'     => $condLevel,
            'avatar'    => $condAvatar
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [];
        return [
            'name.required'     => 'Tên không được để trống',
            'email.required'    => 'Mô tả không được để trống',
            'password.required' => 'Password không được để trống',
            'avatar.required'   => 'Avatar không được để trống',

            'name.min'          => 'Name (:input) không phù hợp, vui lòng nhập ít nhất :min ký tự',
            'email.min'         => 'Email (:input) không phù hợp, vui lòng nhập ít nhất :min ký tự',
            'password.min'      => 'Password (:input) không phù hợp, vui lòng nhập ít nhất :min ký tự',

            'email.email'       => 'Email (:input) không đúng định dạng, vui lòng nhập lại',
            'email.unique'      => 'Email (:input) đã được sử dụng, vui lòng nhập :attribute khác',

            'status.in'         => 'Status không đúng, vui lòng chọn lại',
            'level.in'          => 'Level không đúng, vui lòng chọn lại',
            'password.confirmed'=> 'Password lặp lại không khớp'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    // public function attributes(): array
    // {
    //     return [
    //         'name' => 'Tên',
    //     ];
    // }
}
