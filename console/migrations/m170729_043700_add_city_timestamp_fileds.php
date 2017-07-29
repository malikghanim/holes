<?php

use yii\db\Migration;

class m170729_043700_add_city_timestamp_fileds extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170729_043700_add_city_timestamp_fileds cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('City', 'created_at', $this->integer());
        $this->addColumn('City', 'updated_at', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('City', 'created_at');
        $this->dropColumn('City', 'created_at');
    }
}
