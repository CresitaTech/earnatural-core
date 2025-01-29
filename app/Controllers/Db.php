<?php

namespace App\Controllers;
$dbforge = \Config\Database::forge();

class Db extends BaseController
{

    public function index()
    {
        // check if database is created
        if ($dbforge->createDatabase('earnatural_db', TRUE))
        {
            echo 'Database created successfully...';
        }
        // define table fields
        $fields = array(
            'id' => array(
            'type' => 'INT',
            'constraint' => 9,
            'unsigned' => TRUE,
            'auto_increment' => TRUE
            ),
            'product_name' => array(
            'type' => 'VARCHAR',
            'constraint' => 255
            ),
            'promocode_title' => array(
            'type' => 'VARCHAR',
            'constraint' => 255
            ),
            'promocode' => array(
            'type' => 'VARCHAR',
            'constraint' => 60,
            #'unique' => TRUE
            ),
            'promocode_discount' => array(
            'type' => 'VARCHAR',
            'constraint' => 40
            ),
            'promocode_type' => array(
            'type' => 'VARCHAR',
            'constraint' => 40
            ),
            'status' => array(
            'type' => 'VARCHAR',
            'constraint' => 40
            ),
            'start_date' => array(
            'type' => 'VARCHAR',
            'constraint' => 40
            ),
            'expire_date' => array(
            'type' => 'VARCHAR',
            'constraint' => 40
            ),
            'created_by' => array(
            'type' => 'VARCHAR',
            'constraint' => 40
            ),
            'updated_by' => array(
            'type' => 'VARCHAR',
            'constraint' => 40
            ),
            'created_at' => array(
            'type' => 'DateTime',
            'constraint' => 40
            ),
            'updated_at' => array(
            'type' => 'DateTime',
            'constraint' => 40
            )
        );
        
        $dbforge->addField($fields);
        // define primary key
        $dbforge->addKey('id', TRUE);
        // create table
        $dbforge->createTable('promocodes');
        echo 'Table created successfully...';
    }
}
