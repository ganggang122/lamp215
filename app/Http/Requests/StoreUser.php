<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'uname' => 'required|unique:users|regex:/^[a-zA-Z]{1}\w{5,17}$/',
            'upass' => 'required|regex:/^\w{6,12}$/',
            'repass' => 'required|same:upass',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^1{1}[3-9]{1}\d{9}/|unique:users',
        ];
    }

    public function messages()
    {
        return [
            'uname.required'=>'用户名未填写',
            'uname.regex'=>'用户名由字母开头,可包含字母数字下划线,6-18位',
            'uname.unique'=>'用户名已注册',
            'upass.required'=>'密码未填写',
            'upass.regex'=>'密码可包含字母数字下划线,6到12位组成',
            'repass.required'=>'确认密码未填写',
            'repass.same'=>'两次密码不一致',
            'email.required'=>'邮箱未填写',
            'email.email'=>'邮箱格式错误',
            'email.unique'=>'该邮箱已注册',
            'phone.required'=>'手机未填写',
            'phone.regex'=>'手机格式错误',
            'phone.unique'=>'该手机已注册',
        ];
    }
}
