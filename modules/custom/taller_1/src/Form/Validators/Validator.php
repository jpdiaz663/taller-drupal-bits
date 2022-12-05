<?php

namespace Drupal\taller_1\Form\Validators;


class Validator
{

  private array $constraints = [];

  public function isInvalidData(array $data): ?bool
  {
    return $this->isInvalidNumber($data['field_age']);

  }

  public function isInvalidNumber(int $value, ): bool
  {

    if ($value < 0) {
      $this->add(new Constraints(message: 'El numero no puede ser negativo', constraint: __FUNCTION__));
      return true;
    }

    return false;
  }

  public function getConstraints(): array
  {
    return $this->constraints;
  }


  public function getStringErrors(): string {
    $string = '';

    foreach ($this->constraints as $error) {
      if (is_string($error)) {
        $string .= $error;
      }else{
        $string .= 'ERROR: '.$error->getMessage()."\n";
      }

    }

    return $string;

  }

  public function hasErrors(): bool
  {
    return \count($this->constraints);
  }

  private function add(Constraints $constraints): array
  {
    $this->constraints[] = $constraints;

    return $this->constraints;
  }



}
