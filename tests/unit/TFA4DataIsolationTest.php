<?php

use App\Models\M3\CustomerModel as M3CustomerModel;
use App\Models\M3\UserModel as M3UserModel;
use App\Models\TFA4\CustomerModel as TFA4CustomerModel;
use App\Models\TFA4\UserModel as TFA4UserModel;
use CodeIgniter\Test\CIUnitTestCase;
use Config\Database;

/**
 * @internal
 */
final class TFA4DataIsolationTest extends CIUnitTestCase
{
    public function testTFA4ModelsUsePrefixedTablesWithoutChangingM3Models(): void
    {
        $database = config(Database::class);

        $this->assertSame($database->m3['database'], $database->tfa4['database']);
        $this->assertSame('', $database->m3['DBPrefix']);
        $this->assertSame('tfa4_', $database->tfa4['DBPrefix']);
        $this->assertModelTable(M3CustomerModel::class, 'm3', 'customers');
        $this->assertModelTable(M3UserModel::class, 'm3', 'users');
        $this->assertModelTable(TFA4CustomerModel::class, 'tfa4', 'customers');
        $this->assertModelTable(TFA4UserModel::class, 'tfa4', 'users');
    }

    private function assertModelTable(string $modelClass, string $expectedGroup, string $expectedTable): void
    {
        $reflection = new ReflectionClass($modelClass);
        $model = $reflection->newInstanceWithoutConstructor();

        foreach (['DBGroup' => $expectedGroup, 'table' => $expectedTable] as $propertyName => $expectedValue) {
            $property = $reflection->getProperty($propertyName);
            $property->setAccessible(true);
            $this->assertSame($expectedValue, $property->getValue($model));
        }
    }
}
