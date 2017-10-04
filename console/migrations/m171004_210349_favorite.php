<?php

use yii\db\Migration;

/**
 * Class m171004_210349_favorite
 */
class m171004_210349_favorite extends Migration
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
        echo "m171004_210349_favorite cannot be reverted.\n";

        return false;
    }
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%Favorite}}', [
            'id' => $this->primaryKey(),
            'package_id' => $this->integer(11)->notNull(),
            'job_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'start_date' => $this->bigInteger(),
            'end_date' => $this->bigInteger(),
            'weight' => $this->integer(11)->notNull()->defaultValue(0),
            'active' => $this->boolean()->defaultValue(false),
            'created_at' => $this->string(),
            'updated_at' => $this->string(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-Favorite-job_id',
            'Favorite',
            'job_id',
            'Job',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-Favorite-package_id',
            'Favorite',
            'package_id',
            'Package',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-Favorite-user_id',
            'Favorite',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-Favorite-user_id', 'Favorite');
        $this->dropForeignKey('fk-Favorite-package_id', 'Favorite');
        $this->dropForeignKey('fk-Favorite-job_id', 'Favorite');
        $this->dropTable('{{%Favorite}}');
    }
}
