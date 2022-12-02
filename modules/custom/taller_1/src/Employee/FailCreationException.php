<?php

namespace Drupal\taller_1\Employee;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class FailCreationException extends \Exception
{
  public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
  {
    parent::__construct($message, $code, $previous);
  }

}
