<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Category;

class CategoryRequest extends FormRequest
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
            'title'                     => 'required|max:255',
            'description'               => 'required',
            'ordering'                  => 'min:0',
            'seo_title'                 => 'required',
            'seo_description'           => 'required',
            'seo_alias'                 => [
                'required',
                function($attribute, $value, $fail){
                    $seoAliass      = !empty(request('seo_alias')) ? request('seo_alias') : null;
                    // dd($seoAliass);
                    if(!empty($seoAliass)){
                        $dataCheck  = Category::select('id')
                                        ->whereHas('pages', function($query) use($seoAliass){
                                            $query->where('seo_alias', $seoAliass);
                                        })
                                        ->first();
                        if(!empty($dataCheck)&&$dataCheck->id!=request('id')) $fail('Dường dẫn tĩnh đã trùng với một Chuyên mục khác trên hệ thống!');
                    }
                }
            ],
            'rating_aggregate_count'    => 'required',
            'rating_aggregate_star'     => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required'            => 'Tiêu đề trang không được để trống!',
            'title.max'                 => 'Tiêu đề trang không được vượt quá 255 ký tự!',
            'description'               => 'Mô tả trang không được để trống!',
            'ordering.min'              => 'Giá trị không được nhỏ hơn 0!',
            'seo_title.required'        => 'Tiêu đề SEO không được để trống!',
            'seo_description.required'  => 'Mô tả SEO không được để trống!',
            'seo_alias.required'        => 'Đường dẫn tĩnh không được để trống!',
            'rating_aggregate_count'    => 'Số lượt đánh giá không được để trống!',
            'rating_aggregate_star'     => 'Điểm đánh giá không được để trống!'
        ];
    }
}
