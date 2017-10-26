<?php

use yii\db\Migration;

class m171025_235947_add_store_category_relation extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            "{{%category}}",
            "store_id",
            $this->integer(11)
        );

        $this->createIndex(
            "idx-category-store_id",
            "{{%category}}",
            "store_id"
        );

        $this->addForeignKey(
            "fk-category-store_id",
            "{{%category}}",
            "store_id",
            "{{%store}}",
            "id",
            "CASCADE"
        );


    }

    public function safeDown()
    {
        echo "m171025_235947_add_store_category_relation cannot be reverted.\n";
        $this->dropForeignKey("fk-category-store_id", "{{%category}}");
        $this->dropColumn("{{%category}}", "store_id");

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171025_235947_add_store_category_relation cannot be reverted.\n";

        return false;
    }
    */
}
