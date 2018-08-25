<?php

use yii\db\Migration;

class m180823_081938_create_user_and_login_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'realName' => $this->string()->notNull(),
            'passwordHash' => $this->string()->notNull()->comment('密码hash'),
            'isPasswordExpired' => $this->boolean()->notNull()->defaultValue(false)->comment('密码是否过期'),
            'isDisabled' => $this->boolean()->notNull()->defaultValue(false),
            'lastLoginTime' => $this->dateTime()->comment('最近一次登录时间'),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime(),
        ]);

        // 登录类型字典
        $this->createTable('login_type', [
            'code' => $this->string(20),
        ]);

        // 用户名
        $this->insert('login_type', [
            'code' => 'username',
        ]);

        // 手机号
        $this->insert('login_type', [
            'code' => 'mobile',
        ]);

        $this->addPrimaryKey('pk-code', 'login_type', 'code');

        $this->createTable('login', [
            'userId' => $this->integer()->notNull(),
            'name' => $this->string(60)->notNull()->unique(),
            'type' => $this->string(20)->notNull(),
            'createTime' => $this->dateTime()->notNull(),
            'updateTime' => $this->dateTime(),
        ]);

        $this->addPrimaryKey('pk-name', 'login', 'name');

        $this->addForeignKey('fk-userId-user-id', 'login', 'userId', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-user-id', 'login');
        $this->dropTable('login');
        $this->dropTable('login_type');
        $this->dropTable('user');
    }
}
