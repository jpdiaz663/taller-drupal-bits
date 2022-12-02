<?php

namespace src\Unit;

use Drupal\taller_1\tests\Unit\Employee\EmployeeCreatorTest;

class CityProviderTest extends \PHPUnit\Framework\TestCase
{
  /**
   * @dataProvider healthStatusProvider
   */
  public function testIsValidFindStateFromString(string $expect, string $actual)
  {
    self::assertSame($expect, $actual);
  }


  public function healthStatusProvider(): \Generator
  {
    yield 'Invalid state' => ['Cundinamarca', 'xxxxxx'];
    yield 'Valid find state' => ['Cundinamarca', 'Cundinamarca'];
  }

}
