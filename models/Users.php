<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int|null $chat_id
 * @property string|null $full_name
 * @property string|null $username
 * @property int|null $role
 * @property int|null $status
 * @property string $created_date
 *
 * @property Test[] $tests
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['chat_id', 'role', 'status', 'page', 'words_id'], 'integer'],
            ['status', 'default', 'value' => Yii::$app->config::STATUS_ACTIVE],
            ['role', 'default', 'value' => Yii::$app->config::ROLE_USER],
            ['page', 'default', 'value' => Yii::$app->config::PAGE_HOME],
            ['words_id', 'default', 'value' => null],
            [['created_date'], 'safe'],
            [['full_name', 'username'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chat_id' => Yii::t('app', 'Chat ID'),
            'full_name' => Yii::t('app', 'Full Name'),
            'username' => Yii::t('app', 'Username'),
            'role' => Yii::t('app', 'Role'),
            'status' => Yii::t('app', 'Status'),
            'created_date' => Yii::t('app', 'Created Date'),
        ];
    }

    /**
     * Gets query for [[Tests]].
     *
     * @return \yii\db\ActiveQuery|TestQuery
     */
    public function getTests()
    {
        return $this->hasMany(Test::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

    /**
     * Get user
     *
     * @param integer $chat_id
     * @return array|bool
     */
    public static function getUser(int $chat_id): array|bool
    {
        $sql = <<<SQL
            SELECT * FROM users WHERE chat_id = :chat_id
        SQL;

        return Yii::$app
            ->db
            ->createCommand($sql, [':chat_id' => $chat_id])
            ->queryOne();
    }
}
