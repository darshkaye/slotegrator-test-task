<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%prizes}}`.
 */
class m201203_212822_create_prizes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%prizes}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'kind' => $this->string()->notNull(),
            'value' => $this->integer()->notNull(),
            'status' => $this->string()->notNull()->defaultValue('generated'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%prizes}}');
    }
}
