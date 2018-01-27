<?php

use yii\db\Migration;

/**
 * Class m180127_194423_update_job_fav_start_end_date
 */
class m180127_194423_update_job_fav_start_end_date extends Migration
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
        echo "m180127_194423_update_job_fav_start_end_date cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
         $this->alterColumn('Job', 'fav_start_date', $this->bigInteger());
         $this->alterColumn('Job', 'fav_end_date', $this->bigInteger());
    }

    public function down()
    {
        $this->alterColumn('Job', 'fav_start_date', $this->integer());
        $this->alterColumn('job', 'fav_end_date', $this->integer());
    }
}
