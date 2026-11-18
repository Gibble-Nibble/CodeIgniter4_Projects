<?php

namespace App\Database\Seeds;

use App\Models\TFA4\CustomerModel;
use CodeIgniter\Database\Seeder;

class TFA4DemoCustomersSeeder extends Seeder
{
    protected $DBGroup = 'tfa4';

    public function run()
    {
        $customers = [
            [
                'full_name' => 'Demo Customer 01',
                'email'     => 'demo.customer01@example.test',
                'phone'     => '000-000-0001',
            ],
            [
                'full_name' => 'Demo Customer 02',
                'email'     => 'demo.customer02@example.test',
                'phone'     => '000-000-0002',
            ],
            [
                'full_name' => 'Demo Customer 03',
                'email'     => 'demo.customer03@example.test',
                'phone'     => '000-000-0003',
            ],
            [
                'full_name' => 'Demo Customer 04',
                'email'     => 'demo.customer04@example.test',
                'phone'     => '000-000-0004',
            ],
            [
                'full_name' => 'Demo Customer 05',
                'email'     => 'demo.customer05@example.test',
                'phone'     => '000-000-0005',
            ],
        ];

        $model = new CustomerModel();

        foreach ($customers as $customer) {
            if ($model->where('email', $customer['email'])->first() !== null) {
                continue;
            }

            if ($model->insert($customer) === false) {
                throw new \RuntimeException(sprintf(
                    'Could not seed TFA4 demo customer %s: %s',
                    $customer['email'],
                    implode('; ', $model->errors()),
                ));
            }
        }
    }
}
