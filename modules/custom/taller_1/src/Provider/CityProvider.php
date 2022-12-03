<?php

namespace Drupal\taller_1\Provider;

class CityProvider
{

  private array $states = [];

  public function all(): array
  {
    return $this->states = [
      'Cundinamarca' => [
        'Bogota',
        'Pacho'
      ],
      'Boyaca' => [
        'Duitama',
        'Sogamoso'
      ],
    ];
  }

  public function getByState(string $state): array
  {

    $isCached = empty($this->states);

    if ($isCached) {
       $this->all();
    }

   if (!$this->exist($state)) {
      return [];
   }

    return $this->states[$state];

  }

  private function exist(string $state): bool
  {
    return array_key_exists($state, $this->states);
  }

}
