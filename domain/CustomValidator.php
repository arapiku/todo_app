<?php
namespace Domain;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
  /**
  * ふりがなのバリデーション
  *
  * @param $attribute
  * @param $value
  * @param $parameters
  * @return bool
  */
  public function validateSpecial($attribute, $value, $parameters)
  {
      if (!preg_match('/[^ぁ-んァ-ンーa-zA-Z0-9一-龠０-９\-\r]+/u', $value)) {
          return true;
      }

      return false;
  }
}
