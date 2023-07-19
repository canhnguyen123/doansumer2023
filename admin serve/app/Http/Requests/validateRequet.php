<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class validateRequet extends FormRequest
{
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_name' => [
                'max:35',
                'min:2',
                function ($attribute, $value, $fail) {
                    $this->validateVietnameseCharacters($attribute, $value, $fail);
                },
            ],
            'category_code' => 'integer',
            'phanloai_name'=> [
                'max:35',
                'min:2',
                function ($attribute, $value, $fail) {
                    $this->validateVietnameseCharacters($attribute, $value, $fail);
                },
            ],
            'phanloai_code' => 'integer',
            'brand_name'=> [
                'max:35',
                'min:2',
                function ($attribute, $value, $fail) {
                    $this->validateVietnameseCharacters($attribute, $value, $fail);
                },
            ],
            'brand_code' => 'alpha|min:1|max:15',

            'sizeName' => ['regex:/^[A-Za-z]+$/i', 'min:1', 'max:5'],

            'oldPass'=>'min:6|max:35|',
            'newPass'=>'min:6|max:35|',
            'anewPass'=>'min:6|max:35|',

            'status_name'=>[
                'max:35',
                'min:2',
                function ($attribute, $value, $fail) {
                    $this->validateVietnameseCharacters($attribute, $value, $fail);
                },
            ],
            'status_code'=>'integer|',

            'color_name'=>[
                'max:35',
                'min:2',
                function ($attribute, $value, $fail) {
                    $this->validateVietnameseCharacters($attribute, $value, $fail);
                },
            ],
            'color_code'=>'min:2|max:35',
        ];
    }
    
   
    
    public function messages()
    {
        return[
     
            'category_name.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'category_name.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
            'category_code.integer'=>'Bạn không được nhập :attribute là dạng gì ngoài số',

            'phanloai_name.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'phanloai_name.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
            'phanloai_code.integer'=>'Bạn không được nhập :attribute là dạng gì ngoài số',

            'brand_name.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'brand_name.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
            'brand_code.alpha'=>'Bạn không được nhập :attribute là dạng gì ngoài chữ cái tiếng anh',
            'brand_code.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'brand_code.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
            
            'sizeName.alpha'=>'Bạn không được nhập :attribute là dạng gì ngoài chữ cái tiếng anh',
            'sizeName.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'sizeName.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',

            'oldPass.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'oldPass.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
            'newPass.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'newPass.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
            'anewPass.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'anewPass.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',

            'status_name.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'status_name.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
            'status_name.alpha_spaces'=>'Bạn không được nhập :attribute dang nào ngoài chữ cái dạng tiếng việt',
            'status_code.integer'=>'Bạn không được nhập :attribute ngoài số',

            'color_name.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'color_name.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
            'color_code.min'=>'Bạn không được nhập :attribute nhỏ hơn :min  kí tự',
            'color_code.max'=>'Bạn không được nhập :attribute lớn hơn :max  kí tự',
        ];
    }
    public function attributes()
    {
        return[
            'category_name'=>'tên danh mục',
            'category_code'=>'mã danh mục',
            'phanloai_name'=>'tên phân loại',
            'phanloai_code'=>'mã phân loại',
            'brand_name'=>'tên thương hiệu',
            'brand_code'=>'mã thương hiệu',
            'sizeName'=>'tên size',
            'oldPass'=>'mật khẩu cũ',
            'newPass'=>'mật khẩu mới',
            'anewPass'=>'xác nhận mật khẩu',
            'status_code'=>'mã trạng thái',
            'status_name'=>'tên trạng thái',
            'color_name'=>'tên màu sắc',
            'color_code'=>'mã màu sắc',
        ];
    }
    private function validateVietnameseCharacters($attribute, $value, $fail)
    {
        if (!preg_match('/^[\p{L}\s]+$/u', $value)) {
            $fail('Bạn chỉ được nhập các ký tự chữ tiếng Việt.');
        }
    }
}
