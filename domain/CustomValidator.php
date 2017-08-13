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
      if (!preg_match('|[<>&$%#"\'()!?*+-/_]|', $value)) {
          return true;
      }

      return false;
  }
}
