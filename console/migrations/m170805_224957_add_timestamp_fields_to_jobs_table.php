<?php

use yii\db\Migration;

/**
 * Class m170805_224957_add_timestamp_fields_to_jobs_table
 */
class m170805_224957_add_timestamp_fields_to_jobs_table extends Migration
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
        echo "m170805_224957_add_timestamp_fields_to_jobs_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        //$this->addColumn('Job', 'created_at', $this->integer());
        $this->addColumn('Job', 'updated_at', $this->integer());
    }

    public function down()
    {
        //$this->dropColumn('Job', 'created_at');
        $this->dropColumn('Job', 'updated_at');
    }
}
