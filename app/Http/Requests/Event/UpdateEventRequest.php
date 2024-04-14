<?php


namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            "title" => ["required", "max:155", "min:2"],
            "address" => ["required", "max:155", "min:2"],
            "image" => ["nullable", "image"],
            "start_date" => ["required"],
            "end_date" => ["required"],
            "start_time" => ["required"],
            "country_id" => ["required", "integer"],
            "city_id" => ["required", "integer"],
            "description" => ["required", "string"],
            "num_tickets" => ["required", "integer"],
            "tags" => ["required", "exists:tags,id"]
        ];
    }
}
