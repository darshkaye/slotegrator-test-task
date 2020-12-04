<?php

use yii\db\Migration;

/**
 * Class m201204_212959_add_loyalty_money_cloumnst_to_user_table
 */
class m201204_212959_add_loyalty_money_cloumnst_to_user_table extends Migration
{

    public function up()
    {
        $this->addColumn('user', 'loyalty', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('user', 'money', $this->integer()->notNull()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('user', 'loyalty');
        $this->dropColumn('user', 'money');
    }
}
