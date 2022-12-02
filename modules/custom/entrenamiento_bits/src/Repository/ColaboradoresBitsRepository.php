<?php

namespace Drupal\entrenamiento_bits\Repository;



class ColaboradoresBitsRepository
{

  /**
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;


  public function __construct() {
    $this->database = \Drupal::database();
  }


  public function all() {
    return $this->database->select('colaboradores_bits', 'colabs')
    ->execute()->fetchAll();
  }


}
