<?php

use yii\db\Migration;

class m170729_140158_add_language_to_country_city2 extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170729_140158_add_language_to_country_city2 cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('Country', 'Language_id', $this->integer()->notNull());
        $this->addColumn('City', 'Language_id', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('Country', 'Language_id');
        $this->dropColumn('City', 'Language_id');
    }
}
