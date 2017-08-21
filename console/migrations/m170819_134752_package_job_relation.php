<?php

use yii\db\Migration;

/**
 * Class m170819_134752_package_job_relation
 */
class m170819_134752_package_job_relation extends Migration
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
        echo "m170819_134752_package_job_relation cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('Job', 'package_id', $this->integer(11)->defaultValue(null));
        $this->addForeignKey(
            'fk-Job-package_id',
            'Job',
            'package_id',
            'Package',
            'id'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-Job-package_id', 'Job');
        $this->dropColumn('Job', 'package_id');
    }

}
