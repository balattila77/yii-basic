<?php

use yii\db\Migration;

/**
 * Class m220209_194252_crete_user_table
 */
class m220209_194252_crete_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user',[
            'id' => $this->primaryKey()->unsigned(),
            'username' => $this->string(64)->unique()->notNull(),
            'first_name' => $this->string(64)->notNull(),
            'last_name' => $this->string(64)->notNull(),
            'email' => $this->string(64)->unique()->notNull(),
            'password' => $this->string(100)->notNull(),
            'auth_key' => $this->string(64),
            'access_token' => $this->string(64),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220209_194252_crete_user_table cannot be reverted.\n";
        $this->dropTable('user');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220209_194252_crete_user_table cannot be reverted.\n";

        return false;
    }
    */
}
