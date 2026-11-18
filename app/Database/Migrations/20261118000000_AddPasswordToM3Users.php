<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordToM3Users extends Migration
{
    protected $DBGroup = 'm3';

    public function up()
    {
        $existingUsers = $this->db->table('users')->select('id')->get()->getResultArray();
        $initialPassword = env('M3_INITIAL_USER_PASSWORD');

        if ($existingUsers !== [] && (! is_string($initialPassword) || strlen($initialPassword) < 8)) {
            throw new \RuntimeException(
                'Set M3_INITIAL_USER_PASSWORD to a password of at least eight characters before migrating existing POS users.',
            );
        }

        $this->forge->addColumn('users', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'avatar',
            ],
        ]);

        foreach ($existingUsers as $user) {
            $this->db->table('users')
                ->where('id', $user['id'])
                ->update(['password' => password_hash($initialPassword, PASSWORD_DEFAULT)]);
        }

        $this->forge->modifyColumn('users', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'password');
    }
}
