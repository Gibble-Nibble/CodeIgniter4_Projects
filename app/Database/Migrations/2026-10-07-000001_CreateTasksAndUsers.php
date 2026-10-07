<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasksAndUsers extends Migration
{
    protected $DBGroup = 'tasks';

    public function up()
    {
        $db = db_connect('tasks');

        if (! $db->tableExists('tsa2_users')) {
            $this->forge->addField([
                'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'username'   => ['type' => 'VARCHAR', 'constraint' => 100],
                'full_name'  => ['type' => 'VARCHAR', 'constraint' => 255],
                'email'      => ['type' => 'VARCHAR', 'constraint' => 255],
                'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addUniqueKey('username');
            $this->forge->createTable('tsa2_users');
        } elseif (! $db->fieldExists('password', 'tsa2_users')) {
            $this->forge->addColumn('tsa2_users', [
                'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            ]);
        }

        if (! $db->tableExists('tsa2_tasks')) {
            $this->forge->addField([
                'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'title'      => ['type' => 'VARCHAR', 'constraint' => 255],
                'status'     => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'Pending'],
                'task_date'  => ['type' => 'DATE'],
                'created_at' => ['type' => 'DATETIME', 'null' => true],
                'is_archived'=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('tsa2_tasks');
        } elseif (! $db->fieldExists('is_archived', 'tsa2_tasks')) {
            $this->forge->addColumn('tsa2_tasks', [
                'is_archived' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            ]);
        }

        $users = $db->table('tsa2_users');
        if ($users->where('username', 'demo')->countAllResults() === 0) {
            $users->insert([
                'username'   => 'demo',
                'full_name'  => 'Demo User',
                'email'      => 'demo@example.com',
                'password'   => password_hash('password', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $users->where('username', 'demo')->update([
                'password' => password_hash('password', PASSWORD_DEFAULT),
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropTable('tsa2_tasks', true);
        $this->forge->dropTable('tsa2_users', true);
    }
}
