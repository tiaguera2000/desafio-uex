<?php

namespace App\Http\Requests;

use App\Rules\CpfValidator;
use App\Rules\UniqueCpf;
use App\Rules\UniqueEmail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreContactRequest extends FormRequest
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
            "cpf" => ["required", new CpfValidator(), new UniqueCpf()],
            "phone" => "sometimes",
            "email" => ["required", new UniqueEmail()],
            "state" => "required",
            "city" => "required",
            "district" => "required",
            "street" => "required",
            "number" => "sometimes",
            "zip_code" => "required",
            "lat" => "sometimes",
            "lon" => "sometimes" 
        ];
    }
}
