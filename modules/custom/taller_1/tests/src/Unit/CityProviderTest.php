<?php

namespace Drupal\Tests\taller_1\Unit;


use Drupal\taller_1\Provider\CityProvider;

class CityProviderTest extends \PHPUnit\Framework\TestCase
{
  /**
   * @dataProvider healthStatusProvider
   */
  public function testIsValidFindStateFromString(string $state, array $actual)
  {
    $provider = new CityProvider();
    $cities = $provider->getByState($state);

    $this->assertSame($cities, $actual);

  }

  public function healthStatusProvider(): \Generator
  {
    yield 'Invalid state' => ['xxx', []];
    yield 'Valid find state' => ['Cundinamarca', [
      'Bogota',
      'Pacho',
    ]];
  }

}
