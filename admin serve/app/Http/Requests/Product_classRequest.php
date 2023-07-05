<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Product_classRequest extends FormRequest
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
            'category_name'=>'required|min:1|max:50',
            'category_code'=>'required|integer|min:1',
   
        ];
    }
    public function messages(){
        return[  
            ///cách 1 : viết cho toàn bộ các ô
            'required'=>"Bạn không được bỏ trống :attribute nhập này",
            'min'=>"Bạn không được nhập :attribute nhỏ hơn :min kí tự",
            'max'=>"Bạn không được nhập :attribute lớn hơn :max kí tự",
            'integer'=>"Bạn không được nhập kí tự nào ngoài số ở :attribute",
            'alpha'=>"Bạn không được nhập kí tự nào ngoài chữ ở :attribute",
            /// Cách 2 :viết cho từng ô
            'category_code.min'=>"Bạn không được nhập số âm",
            // 'phanloai_code.min'=>"Bạn không được nhập số âm"
        ];
    }
    public function attributes(){
        return[
            'category_name'=>'tên danh mục',
            'category_code'=>'mã danh mục',
            // 'phanloai_name'=>'tên phân loại',
            // 'phanloai_code'=>'mã phân loại'
        ];
    }
}
