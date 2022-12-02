<?php

namespace Drupal\taller_1\tests\Unit\Employee;


use Drupal\taller_1\Employee\EmployeeCreator;
use Drupal\taller_1\Employee\FailCreationException;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Drupal\taller_1\Employee\EmployeeCreator
 * @group taller_1
 */
class EmployeeCreatorTest extends TestCase
{
  private EmployeeCreator $employeeCreator;

  protected function setUp(): void
  {
    parent::setUp();

    $this->employeeCreator = new EmployeeCreator;
  }


  public function testCreateFromArrayFailCreationException()
  {

    $this->employeeCreator->fromArray(
      [
        ['enterprise' => ['xxxxx']]
      ]
    );

    $this->expectException(FailCreationException::class);
    $this->expectExceptionMessage('Error al salvar la data.');

  }

}
