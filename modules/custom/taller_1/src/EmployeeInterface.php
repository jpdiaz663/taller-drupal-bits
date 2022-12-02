<?php

namespace Drupal\taller_1;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining an employee entity type.
 */
interface EmployeeInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
