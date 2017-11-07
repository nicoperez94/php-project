<?php

use yii\db\Migration;

class m171101_234127_user_store_relation extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            "{{%user}}",
            "store_id",
            $this->integer(11)
        );

        $this->createIndex(
            "idx-user-store_id",
            "{{%user}}",
            "store_id"
        );

        $this->addForeignKey(
            "fk-user-store_id",
            "{{%user}}",
            "store_id",
            "{{%store}}",
            "id",
            "CASCADE"
        );

    }

    public function safeDown()
    {
        echo "m171101_234127_user_store_relation cannot be reverted.\n";
        $this->dropForeignKey("fk-user-store_id", "{{%user}}");
        $this->dropColumn("{{%user}}", "store_id");
//        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171101_234127_user_store_relation cannot be reverted.\n";

        return false;
    }
    */
}
