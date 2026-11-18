<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTFA4Accounts extends Migration
{
    protected $DBGroup = 'tfa4';

    public function up()
    {
        $initialPassword = env('TFA4_INITIAL_USER_PASSWORD');
        if (! is_string($initialPassword) || strlen($initialPassword) < 8) {
            throw new \RuntimeException(
                'Set TFA4_INITIAL_USER_PASSWORD to a password of at least eight characters before migrating.',
            );
        }

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('customers');

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
            ],
            'full_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'avatar' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('users');

        $this->db->table('users')->insert([
            'username'  => 'admin',
            'full_name' => 'POS Administrator',
            'password'  => password_hash($initialPassword, PASSWORD_DEFAULT),
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('customers', true);
    }
}
