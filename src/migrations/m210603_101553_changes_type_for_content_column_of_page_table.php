<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210603_101553_changes_type_for_content_column_of_page_table
 */
class m210603_101553_changes_type_for_content_column_of_page_table extends Migration
{
    /**
     * @var string
     */
    private $_tableName;

    public function init()
    {
        parent::init();
        $this->_tableName = Yii::$app->getModule('pages')->tableName;
    }

    public function safeUp()
    {
        $this->alterColumn($this->_tableName, 'content', 'MEDIUMTEXT');
    }

    public function safeDown()
    {
        $this->alterColumn($this->_tableName, 'content', Schema::TYPE_TEXT);
    }

}
