<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateServiciosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'placa_motocicleta' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => false,
            ],
            'tipo_servicio' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'descripcion' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'estado_servicio' => [
                'type' => 'ENUM',
                'constraint' => ['pendiente', 'en_progreso', 'completado', 'cancelado'],
                'default' => 'pendiente',
                'null' => false,
            ],
            'fecha_solicitud' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'fecha_inicio' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'fecha_completado' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'costo_estimado' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'costo_real' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => true,
            ],
            'tecnico_responsable' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'notas' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'prioridad' => [
                'type' => 'ENUM',
                'constraint' => ['baja', 'media', 'alta', 'urgente'],
                'default' => 'media',
                'null' => false,
            ],
            'kilometraje_actual' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'creado_por' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'modificado_por' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('servicios');

        // Change collation to match existing tables (assuming they use utf8mb4_general_ci)
        $this->db->query("ALTER TABLE `servicios` COLLATE utf8mb4_general_ci");

        // Add foreign keys after table creation
        $this->db->query("
            ALTER TABLE `servicios`
            ADD CONSTRAINT `fk_servicios_motos`
            FOREIGN KEY (`placa_motocicleta`)
            REFERENCES `motos`(`placa`)
            ON DELETE CASCADE ON UPDATE CASCADE
        ");

        $this->db->query("
            ALTER TABLE `servicios`
            ADD CONSTRAINT `fk_servicios_usuario`
            FOREIGN KEY (`creado_por`)
            REFERENCES `usuario`(`idUsuario`)
            ON DELETE CASCADE ON UPDATE CASCADE
        ");
    }

    public function down()
    {
        $this->forge->dropTable('servicios');
    }
}
