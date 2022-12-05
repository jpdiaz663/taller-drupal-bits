<?php

namespace Drupal\Tests\taller_1\Unit;

use Drupal\taller_1\Form\Validators\{
  Constraints, Validator
};

class ValidatorTest extends \PHPUnit\Framework\TestCase
{

  public function testIsValidNumberProvider() {
      $validator = new Validator();

      $this->assertFalse($validator->isInvalidNumber(10), 'is Valid Number');

    }

    public function testIsInvalidNumberProvider() {
      $validator = new Validator();

      $this->assertTrue($this->createInvalidConstraintProvider($validator), 'is invalid Number');
    }

    public function testGetAllConstraintsIfIsInvalidConstraint() {
      $validator = new Validator();

      $this->createInvalidConstraintProvider($validator);

      $this->assertContainsOnlyInstancesOf(
        Constraints::class,
        $validator->getConstraints()
      );

    }

    private function createInvalidConstraintProvider(Validator $validator): bool
    {
      return $validator->isInvalidNumber(-2);
    }

}
