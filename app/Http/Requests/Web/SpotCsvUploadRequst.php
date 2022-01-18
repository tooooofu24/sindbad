<?php

namespace App\Http\Requests\Web;

use App\Consts\Consts;
use Illuminate\Foundation\Http\FormRequest;
use League\Csv\Reader;

class SpotCsvUploadRequst extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'csv' => [
                'required',
                'file',
                'mimes:csv,txt', // mimesの都合上text/csvなのでtxtも許可が必要
                'mimetypes:text/plain',
            ]
        ];
    }
    /*
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'csvファイルは必須です',
            'file' => "csvファイルの形式が違います",
            'mimes' => 'csvファイルの形式が違います',
            'mimetypes' => 'csvファイルの形式が違います'
        ];
    }

    /**
     * バリデータインスタンスの設定
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $errorMessage = '';
            $reader = Reader::createFromPath($this->csv->getPathname(), 'r');
            $records = $reader->getRecords();
            foreach ($records as $index => $record) {
                $name = $record[0];
                $pref = $record[1];
                $row = $index + 1;
                if ($index == 0) {
                    if ($name !== '観光地名') {
                        $errorMessage .= '1行目のフォーマットが正しくない、またはファイルの文字コードが違います' . PHP_EOL;
                    }
                    continue;
                }
                if (!$name) {
                    $errorMessage .= "{$row}行目：観光地名は必須です" . PHP_EOL;
                }
                if (!in_array($pref, Consts::PREF_LIST)) {
                    $errorMessage .= "{$row}行目「{$pref}」：都道府県は「都、道、府、県」を付けた形で入力してください" . PHP_EOL;
                }
            }
            if ($errorMessage) {
                $validator->errors()->add('csv', $errorMessage);
            }
        });
    }
}
