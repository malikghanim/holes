<?php

use yii\db\Migration;

class m170729_140158_add_language_to_country_city2 extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170729_140158_add_language_to_country_city2 cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('Country', 'Language_id', $this->integer()->notNull());
        $this->addColumn('City', 'Language_id', $this->integer()->notNull());

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
        $this->dropColumn('Country', 'Language_id');
        $this->dropColumn('City', 'Language_id');
    }
}
