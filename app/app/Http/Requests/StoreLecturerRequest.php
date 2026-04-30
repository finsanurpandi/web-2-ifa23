<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Rules\Nidn;

class StoreLecturerRequest extends FormRequest
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
            'username' => 'required|min:8',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'department_id' => 'required',
            'role' => 'required',
            'nidn' => ['required' ,'digits:10', new Nidn],
            'address' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Kolom username harus diisi',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'password' => Hash::make($this->password),
            'department_id' => $this->department_id,
            'role' => 1
        ]);
    }
}
