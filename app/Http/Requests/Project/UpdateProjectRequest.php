<?php

namespace App\Http\Requests\Project;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
      'name' => ['sometimes', 'array'],
      'name.en' => ['sometimes', 'string', 'max:255'],
      'name.ar' => ['sometimes', 'string', 'max:255'],

      'description' => ['sometimes', 'array'],
      'description.en' => ['sometimes', 'string'],
      'description.ar' => ['sometimes', 'string'],

      'project_number' => ['sometimes', 'string', 'unique:projects,project_number,' . $this->route('project')],
      'url_youtube' => ['sometimes', 'string', 'unique:projects,url_youtube'],
      'category_id' => ['sometimes', 'exists:categories,id'],

      'tags' => ['nullable', 'array'],
      'tags.*' => ['exists:tags,id'],

      'links' => ['nullable', 'array'],
      'links.*.link_type_id' => ['sometimes_with:links', 'exists:link_types,id'],
      'links.*.url' => ['sometimes_with:links', 'url'],
    ];
  }
}
