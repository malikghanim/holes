<?php

use yii\db\Migration;

class m170729_143655_add_language_id_as_FK_country_city extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170729_143655_add_language_id_as_FK_country_city cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        // add foreign key for table `Country`
        $this->addForeignKey(
            'fk-Country-Languag_id',
            'Country',
            'Language_id',
            'Languag',
            'id',
            'CASCADE'
        );

        // add foreign key for table `City`
        $this->addForeignKey(
            'fk-City-Languag_id',
            'City',
            'Language_id',
            'Languag',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-City-Languag_id', 'City');
        $this->dropForeignKey('fk-Country-Languag_id', 'Country');
    }
}
