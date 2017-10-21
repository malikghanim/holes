<?php

use yii\db\Migration;

/**
 * Class m171021_153035_jobfav
 */
class m171021_153035_jobfav extends Migration
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
        echo "m171021_153035_jobfav cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('Job', 'status', $this->boolean()->notNull()->defaultValue(false));
        $this->addColumn('Job', 'favorite', $this->boolean()->notNull()->defaultValue(false));
        $this->addColumn('Job', 'fav_start_date', $this->integer());
        $this->addColumn('Job', 'fav_end_date', $this->integer());
        $this->addColumn('Job', 'weight', $this->integer(11)->notNull()->defaultValue(0));

    }

    public function down()
    {
        $this->dropColumn('Job', 'status');
        $this->dropColumn('Job', 'favorite');
        $this->dropColumn('Job', 'fav_start_date');
        $this->dropColumn('Job', 'fav_end_date');
        $this->dropColumn('Job', 'weight');
    }
}
