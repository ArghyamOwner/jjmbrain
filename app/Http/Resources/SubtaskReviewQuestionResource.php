<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubtaskReviewQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $inputType = match($this->type) {
            'text' => [
                'type' => 'text_input',
                'name' => Str::random(8),
                'required' => true,
                'hint' => '',
                'prefix' => '',
                'suffix' => '',
                'max_length' => null,
                'min_length' => null
            ],
            'phone' => [
                "type" => "mobile_input",
                "name" => Str::random(8),
                "required" => true,
                "hint" => "",
                "prefix" => "+91",
                "suffix" => "",
                "max_length" => 10,
                "min_length" => null
            ],
            'choice' => [
                "type" => "choice_field",
                "name" => Str::random(8),
                "required" => true,
                "hint" => "",
                "prefix" => "",
                "suffix" => "",
                "max_length" => null,
                "min_length" => null,
            ],
            'date' => [
                "type" => "date_input",
                "name" => Str::random(8),
                "required" => true,
                "hint" => "",
                "prefix" => "",
                "suffix" => "",
                "max_length" => null,
                "min_length" => null
            ]
        };

        return [
            'heading' => $this->question,
            'description' => $this->description,
            'type' => $this->type,
            'options' => $this->options ?? [],
            'show_form' => (bool) $this->show_form,
            ...$inputType
        ];
    }
}
