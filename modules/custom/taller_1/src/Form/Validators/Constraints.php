<?php

namespace Drupal\taller_1\Form\Validators;

class Constraints
{
  public function __construct(
   private string $message,
   private string $constraint,
   private ?string $error = null,
  )
  {
  }

  public function getError(): ?string
  {
    return $this->error;
  }


  public function getMessage(): string
  {
    return $this->message;
  }


  public function getConstraint(): string
  {
    return $this->constraint;
  }


}
