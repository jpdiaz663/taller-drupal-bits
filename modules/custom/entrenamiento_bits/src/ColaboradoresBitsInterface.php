<?php

namespace Drupal\entrenamiento_bits;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining an entrenamiento bits entity type.
 */
interface ColaboradoresBitsInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
