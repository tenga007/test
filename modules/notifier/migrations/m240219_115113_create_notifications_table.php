<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification}}`.
 */
class m240219_115113_create_notifications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notifications}}', [
            'id' => $this->primaryKey(),
            'integrator' => $this->tinyInteger()->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(0),
            'text' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'sended_at' => $this->timestamp(),
        ]);

        $this->insertData();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notifications}}');
    }

    private function insertData()
    {
        $this->batchInsert(
            '{{%notifications}}',
            ['integrator', 'text'],
            [
                [0, 'test sms 1'],
                [1, 'test telegram 1'],
                [0, 'test sms 2'],
                [0, 'test sms 3'],
                [0, 'test sms 4'],
                [1, 'test telegram 2'],
                [1, 'test telegram 3'],
                [0, 'test sms 5'],
                [1, 'test telegram 4'],
                [1, 'test telegram 5'],
            ]
        );
    }
}
