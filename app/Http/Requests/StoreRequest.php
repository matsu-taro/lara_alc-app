<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'alc_name' => ['required', 'string'],
      'price' => ['nullable', 'integer'],
      'new_place' => 'nullable',
      'place' => ['place_check', 'same_place_check'],
      'status' => ['required'],
      'type' => ['required'],
      'memo' => 'nullable',
      'files' => ['nullable', 'max:3'],
    ];
  }

  public function messages()
  {
    return [
      'alc_name' => '名前を入力してください。',
      'type' => 'お酒のタイプを選んでください。',
      'place_check' => 'お店は１箇所決めてください。',
      'same_place_check' => '「過去のデータから選ぶ」より選んでください。',
      'files' => '画像は3枚以下にしてください。',
    ];
  }
}
