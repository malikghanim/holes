<?php

use yii\db\Migration;

/**
 * Class m171224_012703_favorite_soft_delete
 */
class m171224_012703_favorite_soft_delete extends Migration
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
        echo "m171224_012703_favorite_soft_delete cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('Favorite', 'is_deleted', $this->boolean()->notNull()->defaultValue(false));
    }

    public function down()
    {
        $this->dropColumn('Favorite', 'is_deleted');
    }
}
