<?php

namespace Drupal\taller_1\Employee;

use Drupal\Core\Entity\EntityBase;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\taller_1\Entity\Employee;

class EmployeeCreator
{

  private ?EntityBase $employee;

  public function fromArray(array $data): void
  {

    empty($data) && throw new FailCreationException('Error campos vacios.');

    $this->employee = Employee::create($data);

    try {
      $this->employee->save();
    } catch (EntityStorageException) {
      throw new FailCreationException('Error al salvar la data.');
    }

  }


  public function getEmployee(): EntityBase
  {
    return $this->employee;
  }


}
