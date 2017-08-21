<?php

use yii\db\Migration;

/**
 * Class m170819_132107_create_packages
 */
class m170819_132107_create_packages extends Migration
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
        echo "m170819_132107_create_packages cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('{{%Package}}', [
            'id' => $this->primaryKey(),
            'title' => $this->char(100)->notNull()->defaultValue(''),
            'description' => $this->string()->defaultValue(''),
            'price' => $this->float()->notNull(),
            'duration' => $this->integer(11)->notNull()->defaultValue(0),
            'duaration_unit' => $this->char(20)->notNull()->defaultValue(''),
            'duration' => $this->integer(11)->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'created_at' => $this->integer(),
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%Package}}');
    }
}
