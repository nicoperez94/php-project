<?php

use yii\db\Migration;
use yii\db\Schema;

class m171016_015654_init_php_project extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if($this->db->driverName == 'mysql'){
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable("{{%product}}", [
            "id"    =>  $this->primaryKey(),
            "name"    =>  $this->string()->notNull(),
            "price"  => $this->float()->notNull(),
            "image" =>  $this->string(),
            "bar_code"   =>  $this->text(),
            "stock" =>  $this->integer(),
            "store_id" => $this->integer(11)
        ], $tableOptions);

        $this->createTable("{{%category}}", [
            "id"    =>  $this->primaryKey(),
            "name"  =>  $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable("{{%category_product}}",[
            "product_id" => $this->integer(11),
            "category_id" => $this->integer(11)
        ], $tableOptions);

        $this->createTable("{{%order_product}}",[
            "id"    =>  $this->primaryKey(),
            "quantity"  =>  $this->integer(),
            "product_id"    =>  $this->integer(11)->notNull(),
            "order_id" => $this->integer(11)
        ], $tableOptions);

        $this->createTable("{{%order}}",[
            "id"    =>$this->primaryKey(),
            "state" =>$this->string(50)->notNull(),
            "shipping_place"    =>  $this->text(),
            "price" =>$this->float()->notNull(),
            "user_id" => $this->integer(11),
            "shipping_id" => $this->integer(11),
            "store_id" => $this->integer(11)
        ], $tableOptions);

        $this->createTable("{{%delivery}}",[
            "id"    =>  $this->primaryKey(),
            "name"  =>  $this->string(50)->notNull(),
            "store_id" =>$this->integer(11)
        ], $tableOptions);

//        echo '  Delivery\n';

        $this->createTable("{{%shipping}}",[
            "id"    =>  $this->primaryKey(),
            "description"   =>  $this->text(),
            "route" =>  $this->text(),
            "state" =>  $this->string(50)->notNull(),
            "price" =>  $this->float()->notNull(),
            "delivery_id"   =>  $this->integer(11),
            "store_id" => $this->integer(11)
        ], $tableOptions);

        $this->createTable("{{%store}}",[
            "id"    =>  $this->primaryKey(),
            "name"  =>  $this->string(50),
            "location"  =>  $this->text(),
        ], $tableOptions);

        $this->createIndex(
            "idx-product-store_id",
            "{{%product}}",
            "store_id"
        );

        $this->addForeignKey(
            "fk-product-store_id",
            "{{%product}}",
            "store_id",
            "{{%store}}",
            "id",
            "CASCADE"
        );

        $this->createIndex(
            "idx-category_product-product_id",
            "{{%category_product}}",
            "product_id"
        );

        $this->createIndex(
            "idx-category_product-category_id",
            "{{%category_product}}",
            "category_id"
        );

        $this->addForeignKey(
            "fk-category_product-product_id",
            "{{%category_product}}",
            "product_id",
            "{{%product}}",
            "id",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk-category_product-category_id",
            "{{%category_product}}",
            "category_id",
            "{{%category}}",
            "id",
            "CASCADE"
        );

        $this->createIndex(
            "idx-order_product-product_id",
            "{{%order_product}}",
            "product_id"
        );

        $this->createIndex(
            "idx-order_product-order_id",
            "{{%order_product}}",
            "order_id"
        );

        $this->addForeignKey(
            "fk-order_product-order_id",
            "{{%order_product}}",
            "order_id",
            "{{%order}}",
            "id",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk-order_product-product_id",
            "{{%order_product}}",
            "product_id",
            "{{%product}}",
            "id",
            "CASCADE"
        );

        $this->createIndex(
            "idx-order-user_id",
            "{{%order}}",
            "user_id"
        );

        $this->createIndex(
            "idx-order-shipping_id",
            "{{%order}}",
            "shipping_id"
        );

        $this->createIndex(
            "idx-order-store_id",
            "{{%order}}",
            "store_id"
        );

        $this->addForeignKey(
            "fk-order-user_id",
            "{{%order}}",
            "user_id",
            "{{%user}}",
            "id",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk-order-shipping_id",
            "{{%order}}",
            "shipping_id",
            "{{%shipping}}",
            "id",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk-order-store_id",
            "{{%order}}",
            "store_id",
            "{{%store}}",
            "id",
            "CASCADE"
        );

        $this->createIndex(
            "idx-delivery-store_id",
            "{{%delivery}}",
            "store_id"
        );

        $this->addForeignKey(
            "fk-delivery-store_id",
            "{{%delivery}}",
            "store_id",
            "{{%store}}",
            "id",
            "CASCADE"
        );

        $this->createIndex(
            "idx-shipping-store_id",
            "{{%shipping}}",
            "store_id"
        );

        $this->createIndex(
            "idx-shipping-delivery_id",
            "{{%shipping}}",
            "delivery_id"
        );

        $this->addForeignKey(
            "fk-shipping-store_id",
            "{{%shipping}}",
            "store_id",
            "{{%store}}",
            "id",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk-shipping-delivery_id",
            "{{%shipping}}",
            "delivery_id",
            "{{%delivery}}",
            "id",
            "CASCADE"
        );

        ////////////////////////////////////////////////////////



//        echo '  store-shipping_id\n';
//
//        echo '\n';
//        echo '3- Altering User Table\n';

        //Todo Agregar referencia de usuario a orden

//        $this->addColumn("{{%user}}", "order_id", $this->integer(11));
//        $this->addColumn("{{%user}}", "store_id", $this->integer(11));

//        echo '  Add columns\n';

//        $this->createIndex("idx-user-order_id", "{{%user}}", "order_id");
//        $this->addForeignKey(
//            "fk-user-order_id",
//            "{{%user}}",
//            "order_id",
//            "{{%order}}",
//            "id",
//            "CASCADE"
//        );

//        echo '  user-order_id';

//        $this->createIndex("idx-user-store_id", "{{%user}}" ,"store_id");
//        $this->addForeignKey(
//            "fk-user-store_id",
//            "{{%user}}",
//            "store_id",
//            "{{%store}}",
//            "id",
//            "CASCADE"
//        );

//        echo '  user-order_id';
    }

    public function safeDown()
    {
        //echo "m171016_015654_init_php_project cannot be reverted.\n";

        $this->dropForeignKey("fk-product-store_id","{{%product}}");
//        $this->dropIndex("idx-product-store_id","{{%product}}");
        $this->dropForeignKey("fk-category_product-product_id", "{{%category_product}}");
//        $this->dropIndex("idx-category_product-product_id","{{%category_product}}");
        $this->dropForeignKey("fk-category_product-category_id","{{%category_product}}");
//        $this->dropIndex("idx-category_product-category_id","{{%category_product}}");
        $this->dropForeignKey("fk-order_product-product_id","{{%order_product}}");
//        $this->dropIndex("idx-order_product-product_id","{{%order_product}}");
        $this->dropForeignKey("fk-order_product-order_id","{{%order_product}}");
//        $this->dropIndex("idx-order_product-order_id","{{%order_product}}");
        $this->dropForeignKey("fk-order-user_id","{{%order}}");
//        $this->dropIndex("idx-order-user_id","{{%order}}");
        $this->dropForeignKey("fk-order-shipping_id","{{%order}}");
//        $this->dropIndex("idx-order-shipping_id","{{%order}}");
        $this->dropForeignKey("fk-order-store_id","{{%order}}");
//        $this->dropIndex("idx-order-store_id","{{%order}}");
        $this->dropForeignKey("fk-delivery-store_id", "{{%delivery}}");
//        $this->dropIndex("idx-delivery-store_id","{{%delivery}}");
        $this->dropForeignKey("fk-shipping-store_id","{{%shipping}}");
//        $this->dropIndex("idx-shipping-store_id","{{%shipping}}");
        $this->dropForeignKey("fk-shipping-delivery_id","{{%shipping}}");
//        $this->dropIndex("idx-shipping-delivery_id","{{%shipping}}");



//        echo '2- Dropping tables';

        $this->dropTable("{{%store}}");
        $this->dropTable("{{%shipping}}");
        $this->dropTable("{{%order}}");
        $this->dropTable("{{%order_product}}");
        $this->dropTable("{{%product}}");
        $this->dropTable("{{%category}}");
        $this->dropTable("{{%delivery}}");
        $this->dropTable("{{%category_product}}");

//        echo '3- dropping User columns';
//        $this->dropColumn("{{%user}}","order_id");
//        $this->dropColumn("{{%user}}","store_id");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171016_015654_init_php_project cannot be reverted.\n";

        return false;
    }
    */
}
