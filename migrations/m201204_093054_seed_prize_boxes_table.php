<?php

use yii\db\Migration;

/**
 * Class m201204_093054_seed_prize_boxes_table
 * Handles the inserting basic data to table `{{%prize_boxes}}`.
 */
class m201204_093054_seed_prize_boxes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%prize_boxes}}', [
            'name' => 'phone',
        ]);

        $this->insert('{{%prize_boxes}}', [
            'name' => 'notebook',
        ]);

        $this->insert('{{%prize_boxes}}', [
            'name' => 'ring',
        ]);

        $this->insert('{{%prize_boxes}}', [
            'name' => 'refrigerator',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%prize_boxes}}');

        return false;
    }
}
