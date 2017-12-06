<?php

use yii\db\Migration;

/**
 * Class m171206_002118_package_visibility
 */
class m171206_002118_package_visibility extends Migration
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
        echo "m171206_002118_package_visibility cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('Package', 'visible', $this->integer()->notNull()->defaultValue(1));
    }

    public function down()
    {
        $this->dropColumn('Package', 'visible');
    }
}
