<?php

namespace App\Http\Requests;

use App\Rules\CpfValidator;
use App\Rules\UniqueCpf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "cpf" => ["required", new CpfValidator()],
            "phone" => "sometimes",
            "email" => "required",
            "state" => "required",
            "city" => "required",
            "district" => "required",
            "street" => "required",
            "number" => "sometimes",
            "zip_code" => "required",
            "lat" => "sometimes",
            "lon" => "sometimes",
            "complement" => "sometimes"
        ];
    }
}
