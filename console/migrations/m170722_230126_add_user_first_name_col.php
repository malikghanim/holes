<?php

use yii\db\Migration;

class m170722_230126_add_user_first_name_col extends Migration
{
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170722_230126_add_user_first_name_col cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('user', 'first_name', $this->string());
        $this->addColumn('user', 'last_name', $this->string());
        $this->addColumn('user', 'role', $this->integer());
        $this->addColumn('user', 'company', $this->string());
        $this->addColumn('user', 'api_key', $this->string());
        $this->addColumn('user', 'api_secret', $this->string());
        $this->addColumn('user', 'facebook_id', $this->string());
        $this->addColumn('user', 'google_id', $this->string());
        $this->addColumn('user', 'is_system_password', $this->integer());
        $this->addColumn('user', 'has_verified_email', $this->integer());
        $this->addColumn('user', 'email_confirm_token', $this->string());
        $this->addColumn('user', 'user_group', $this->integer());
        $this->addColumn('user', 'ip_address', $this->string());
    }

    public function down()
    {
        $this->dropColumn('user', 'first_name');
        $this->dropColumn('user', 'last_name');
        $this->dropColumn('user', 'role');
        $this->dropColumn('user', 'company');
        $this->dropColumn('user', 'api_key');
        $this->dropColumn('user', 'api_secret');
        $this->dropColumn('user', 'facebook_id');
        $this->dropColumn('user', 'google_id');
        $this->dropColumn('user', 'is_system_password');
        $this->dropColumn('user', 'has_verified_email');
        $this->dropColumn('user', 'email_confirm_token');
        $this->dropColumn('user', 'user_group');
        $this->dropColumn('user', 'ip_address');
    }
}
