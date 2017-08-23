<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PostRequest;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     * @dataProvider dataproviderValidator
     */
     public function testValidator($item, $data, $expect) {
       $dataList = [$item => $data];
       $request = new PostRequest();
       $rules = $request->rules();
       $rules = array_only($rules, $item);
       $validator = Validator::make($dataList, $rules);
       $result = $validator->passes();
       $this->assertEquals($expect, $result);
     }

     public function dataproviderValidator() {
       return [
         '正常(title)' => ['title', 'タイトル', true],
         '正常(deadline)' => ['deadline', '2017/09/09', true],
         '必須エラー(deadline)' => ['deadline', '', false],
         '必須エラー(title)' => ['title', '', false],
         '最大文字数エラー(title)' => ['title', str_repeat('a', 31), false],
         'ユニークエラー(title)' => ['title', strpos('タイトル', 'タイトル'), false],
         '特殊文字エラー(title)' => ['title', preg_match('/[^ぁ-んァ-ンーa-zA-Z0-9一-龠０-９\-\r]+/u', 'dad'), false],
       ];
     }
}
