<?php

namespace Drupal\Tests\taller_1\Unit\Employee;


use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\taller_1\Employee\EmployeeCreator;
use Drupal\taller_1\Employee\FailCreationException;
use Drupal\Tests\UnitTestCase;
use PHPUnit\Framework\TestCase;

/**
 * @coversDefaultClass \Drupal\taller_1\Employee\EmployeeCreator
 * @group taller_1
 */
class EmployeeCreatorTest extends UnitTestCase
{
  private EmployeeCreator $employeeCreator;

  protected function setUp(): void
  {
    parent::setUp();

    $this->employeeCreator = new EmployeeCreator();
  }


  public function testCreateFromArrayFailCreationException()
  {

    $this->expectException(FailCreationException::class);
    $this->expectExceptionMessage('Error campos vacios.');

    $this->employeeCreator->fromArray([]);

  }


}
