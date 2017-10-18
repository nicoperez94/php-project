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

//        echo '----------------------------------------------------\n';
//        echo '                  Starting Migration                \n';
//        echo '----------------------------------------------------\n';
//        echo '\n';
//        echo '1- Creating tables\n';
        $this->createTable("{{%product}}", [
            "id"    =>  $this->primaryKey(),
            "name"    =>  $this->string()->notNull(),
            "price"  => $this->float()->notNull(),
            "image" =>  $this->string(),
            "bar_code"   =>  $this->text(),
            "stock" =>  $this->integer()
        ], $tableOptions);

//        echo '  Product\n';

        $this->createTable("{{%category}}", [
            "id"    =>  $this->primaryKey(),
            "name"  =>  $this->string()->notNull(),
            "product_id"    =>  $this->integer(11)
        ]);

//        echo '  Category\n';

        $this->createTable("{{%order_product}}",[
            "id"    =>  $this->primaryKey(),
            "product_id"    =>  $this->integer(11)->notNull(),
            "quantity"  =>  $this->integer()
        ]);

//        echo '  Order_Product\n';

        $this->createTable("{{%order}}",[
            "id"    =>$this->primaryKey(),
            "state" =>$this->string(50)->notNull(),
            "shipping_place"    =>  $this->text(),
            "price" =>$this->float()->notNull(),
            "order_product_id"  =>  $this->integer(11)->notNull()
        ]);

//        echo '  Order\n';

        $this->createTable("{{%delivery}}",[
            "id"    =>  $this->primaryKey(),
            "name"  =>  $this->string(50)->notNull()
        ]);

//        echo '  Delivery\n';

        $this->createTable("{{%shipping}}",[
            "id"    =>  $this->primaryKey(),
            "description"   =>  $this->text(),
            "route" =>  $this->text(),
            "state" =>  $this->string(50)->notNull(),
            "price" =>  $this->float()->notNull(),
            "delivery_id"   =>  $this->integer(11),
            "order_id"  =>  $this->integer(11)
        ]);

//        echo '  Shipping\n';

        $this->createTable("{{%store}}",[
            "id"    =>  $this->primaryKey(),
            "name"  =>  $this->string(50),
            "location"  =>  $this->text(),
            "category_id"   =>  $this->integer(11),
            "product_id"    =>  $this->integer(11),
            "order_id"  =>  $this->integer(11),
            "delivery_id"   =>  $this->integer(11),
            "shipping_id"   =>  $this->integer(11)
        ]);

//        echo '  Store\n';
//        echo '\n';
//        echo '2- Indexing and Creating Foreign Keys\n';
        $this->createIndex(
            "idx-category-product_id",
            "{{%category}}",
            "product_id"
        );

        $this->addForeignKey(
            "fk-category-product_id",
            "{{%category}}",
            "product_id",
            "{{%product}}",
            "id",
            "CASCADE"
        );

//        echo '  category-product_id\n';


        $this->createIndex("idx-order_product-product_id", "{{%order_product}}","product_id");
        $this->addForeignKey(
            "fk-order_product-product_id",
            "{{%order_product}}",
        "product_id",
            "{{%product}}",
            "id",
            "CASCADE"
        );

//        echo '  order_product-product_id\n';

        $this->createIndex("idx-order-order_product_id","{{%order}}","order_product_id");
        $this->addForeignKey(
            "fk-order-order_product_id",
            "{{%order}}",
            "order_product_id",
            "{{%order_product}}",
            "id",
            "CASCADE"
        );

//        echo '  order-order_product_id\n';

        $this->createIndex("idx-shipping-delivery_id","{{%shipping}}","delivery_id");
        $this->addForeignKey(
            "fk-shipping-delivery_id",
            "{{%shipping}}",
            "delivery_id",
            "{{%delivery}}",
            "id",
            "CASCADE"
        );

//        echo '  shipping-delivery_id\n';

        $this->createIndex("idx-shipping-order_id","{{%shipping}}","order_id");
        $this->addForeignKey(
            "fk-shipping-order_id",
            "{{%shipping}}",
            "order_id",
            "{{%order}}",
            "id",
            "CASCADE"
        );

//        echo '  shipping-order_id\n';

        $this->createIndex("idx-store-category_id", "{{%store}}", "category_id");
        $this->addForeignKey(
            "fk-store-category_id",
            "{{%store}}",
            "category_id",
            "{{%category}}",
            "id",
            "CASCADE"
        );

//        echo '  store-order_id\n';

        $this->createIndex("idx-store-product_id", "{{%store}}","product_id");
        $this->addForeignKey(
            "fk-store-product_id",
            "{{%store}}",
            "product_id",
            "{{%product}}",
            "id",
            "CASCADE"
        );

//        echo '  store-product_id\n';

        $this->createIndex("idx-store-order_id", "{{%store}}","order_id");
        $this->addForeignKey(
            "fk-store-order_id",
            "{{%store}}",
            "order_id",
            "{{%order}}",
            "id",
            "CASCADE"
        );

//        echo '  store-order_id\n';

        $this->createIndex("idx-store-delivery_id", "{{%store}}","delivery_id");
        $this->addForeignKey(
            "fk-store-delivery_id",
            "{{%store}}",
            "delivery_id",
            "{{%delivery}}",
            "id",
            "CASCADE"
        );

//        echo '  store-delivery_id\n';

        $this->createIndex("idx-store-shipping_id", "{{%store}}", "shipping_id");
        $this->addForeignKey(
            "fk-store-shipping_id",
            "{{%store}}",
            "shipping_id",
            "{{%shipping}}",
            "id",
            "CASCADE"
        );

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

//        echo '----------------------------------------------------\n';
//        echo '              Starting Migration/down               \n';
//        echo '----------------------------------------------------\n';
//        echo '\n';
//        echo '1- Dropping index and foreign keys';
//        $this->dropForeignKey("fk-user-order_id","{{%user}}");
//        $this->dropIndex("idx-user-order_id","{{%user");
//        $this->dropForeignKey("fk-user-store_id", "{{%user}}");
//        $this->dropIndex("idx-user-store_id","{{%user}}");
        $this->dropForeignKey("fk-store-order_id","{{%store}}");
        $this->dropIndex("idx-store-order_id", "{{%store}}");
        $this->dropForeignKey("fk-store-product_id","{{%store}}");
        $this->dropIndex("idx-store-product_id", "{{%store}}");
        $this->dropForeignKey("fk-store-category_id","{{%store}}");
        $this->dropIndex("idx-store-category_id","{{%store}}");
        $this->dropForeignKey("fk-store-delivery_id","{{%store}}");
        $this->dropIndex("idx-store-delivery_id","{{%store}}");
        $this->dropForeignKey("fk-store-shipping_id","{{%store}}");
        $this->dropIndex("idx-store-shipping_id","{{%store}}");
        $this->dropForeignKey("fk-shipping-delivery_id","{{%shipping}}");
        $this->dropIndex("idx-shipping-delivery_id","{{%shipping}}");
        $this->dropForeignKey("idx-shipping-order_id","{{%shipping}}");
        $this->dropIndex("idx-shipping-order_id", "{{%shipping}}");
        $this->dropForeignKey("fk-category-product_id", "{{%category}}");
        $this->dropIndex("idx-category-product_id", "{{%category}}");
        $this->dropForeignKey("fk-order_product-product_id", "order_product");
        $this->dropIndex("idx-order-order_product_id", "order_product_id");
        $this->dropForeignKey("fk-order-order_product_id","order");
        $this->dropIndex("idx-order_product-product_id", "order_product");

//        echo '2- Dropping tables';

        $this->dropTable("{{%store}}");
        $this->dropTable("{{%shipping}}");
        $this->dropTable("{{%order}}");
        $this->dropTable("{{%order_product}}");
        $this->dropTable("{{%product}}");
        $this->dropTable("{{%category}}");
        $this->dropTable("{{%delivery}}");

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
