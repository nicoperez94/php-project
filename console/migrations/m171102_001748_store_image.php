<?php

use yii\db\Migration;

class m171102_001748_store_image extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            "{{%store}}",
            "image",
            $this->string(255)
        );
    }

    public function safeDown()
    {
        echo "m171102_001748_store_image cannot be reverted.\n";
        $this->dropColumn("{{%store}}", "image");
//        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171102_001748_store_image cannot be reverted.\n";

        return false;
    }
    */
}
