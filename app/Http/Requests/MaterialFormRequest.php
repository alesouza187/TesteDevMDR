<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        if ($this->has('valor')) {
            $valor = $this->input('valor');

            // Remove espaços extras e substitui vírgulas por pontos
            $valor = trim($valor);
            $valor = str_replace(',', '.', $valor);

            // Substitui todos os pontos exceto o último por nada
            $lastDotPos = strrpos($valor, '.');
            if ($lastDotPos !== false) {
                $valor = preg_replace('/\.(?![^.]*$)/', '', $valor);
            }

            // Garantir que o valor tenha duas casas decimais
            $valor = number_format((float) $valor, 2, '.', '');
            // dd($valor);

            $this->merge([
                'valor' => $valor,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => ['required'],
            'descricao' => ['required'],
            'valor' => ['regex:/^\d{1,8}(\.\d{1,2})?$/']
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'O campo código é obrigatório',
            'descricao.required' => 'O campo descrição é obrigatório',
            'valor.regex' => 'O valor deve estar entre 0 e 99.999.999,99.',
        ];
    }
}
