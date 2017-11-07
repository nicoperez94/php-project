<?php

use yii\db\Migration;

class m171102_005949_store_details extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            "{{%store}}",
            "detalle",
            $this->text()
        );
    }

    public function safeDown()
    {
        echo "m171102_005949_store_details cannot be reverted.\n";
        $this->dropColumn("{{%store}}", "detalle");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171102_005949_store_details cannot be reverted.\n";

        return false;
    }
    */
}
