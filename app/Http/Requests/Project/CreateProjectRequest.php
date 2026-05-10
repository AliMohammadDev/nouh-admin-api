<?php

namespace App\Http\Requests\Project;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
   * @return array<string, ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'name' => ['required', 'array'],
      'name.en' => ['required', 'string', 'max:255'],
      'name.ar' => ['required', 'string', 'max:255'],

      'description' => ['required', 'array'],
      'description.en' => ['required', 'string'],
      'description.ar' => ['required', 'string'],

      'project_number' => ['required', 'string', 'unique:projects,project_number'],
      'url_youtube' => ['required', 'string', 'unique:projects,url_youtube'],
      'category_id' => ['required', 'exists:categories,id'],

      'tags' => ['nullable', 'array'],
      'tags.*' => ['exists:tags,id'],

      'links' => ['nullable', 'array'],
      'links.*.link_type_id' => ['required_with:links', 'exists:link_types,id'],
      'links.*.url' => ['required_with:links', 'url'],
    ];
  }
}
