<?php

use yii\db\Migration;

/**
 * Class m170805_145434_jobs
 */
class m170805_145434_jobs extends Migration
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
        echo "m170805_145434_jobs cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->createTable('{{%Job}}', [
            'id' => $this->primaryKey(),
            'title' => $this->char(100)->notNull()->defaultValue(''),
            'description' => $this->string()->defaultValue(''),
            'mobile' => $this->char(20)->notNull(),
            'working_from' => $this->char(20)->notNull(),
            'working_to' => $this->char(20)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'CountryCode' => $this->char(3)->notNull(),
            'city_id' => $this->integer(11)->notNull(),
            'address' => $this->string()->defaultValue(''),
            'user_id' => $this->integer(11)->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        // add foreign key for table `Job`
        $this->addForeignKey(
            'fk-Job-user_id',
            'Job',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `Job`
        $this->addForeignKey(
            'fk-Job-CountryCode',
            'Job',
            'CountryCode',
            'Country',
            'Code',
            'CASCADE'
        );

        // add foreign key for table `Job`
        $this->addForeignKey(
            'fk-Job-city_id',
            'Job',
            'city_id',
            'City',
            'id',
            'CASCADE'
        );

        // add foreign key for table `Job`
        $this->addForeignKey(
            'fk-Job-category_id',
            'Job',
            'category_id',
            'ymd_categories',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-Job-category_id', 'Job');
        $this->dropForeignKey('fk-Job-city_id', 'Job');
        $this->dropForeignKey('fk-Job-CountryCode', 'Job');
        $this->dropForeignKey('fk-Job-user_id', 'Job');
        $this->dropTable('{{%Job}}');
    }
}
