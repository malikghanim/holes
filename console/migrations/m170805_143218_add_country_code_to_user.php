<?php

use yii\db\Migration;

/**
 * Class m170805_143218_add_country_code_to_user
 */
class m170805_143218_add_country_code_to_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m170805_143218_add_country_code_to_user cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('user', 'CountryCode', $this->char(3)->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('user', 'CountryCode');
    }

}
