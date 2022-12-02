<?php

namespace Drupal\taller_1\Provider;

class CityProvider
{

  private array $states;

  public function getAll(): array
  {
    return $this->states = [
      'Cundinamarca' => [
        'Bogota',
        'Pacho'
      ],
      'Boyaca' => [
        'Duitama',
        'Sogamoso'
      ]
    ];
  }

  public function getByState(string $state) {

    if (!empty($this->states)) {
        return $this->states[$state] ?? [];
    }

    return $this->getAll()[$state];
  }

}
