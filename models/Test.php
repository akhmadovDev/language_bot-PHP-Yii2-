<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property int $id
 * @property int|null $words_id
 * @property int|null $user_id
 * @property int|null $all_attemp
 * @property int|null $last_attemp
 * @property int|null $correct
 * @property int|null $incorrect
 *
 * @property Users $user
 * @property Words $words
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['words_id', 'user_id', 'all_attemp', 'last_attemp', 'correct', 'incorrect'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['user_id' => 'id']],
            [['words_id'], 'exist', 'skipOnError' => true, 'targetClass' => Words::class, 'targetAttribute' => ['words_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'words_id' => Yii::t('app', 'Words ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'all_attemp' => Yii::t('app', 'All Attemp'),
            'last_attemp' => Yii::t('app', 'Last Attemp'),
            'correct' => Yii::t('app', 'Correct'),
            'incorrect' => Yii::t('app', 'Incorrect'),
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Words]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWords()
    {
        return $this->hasOne(Words::class, ['id' => 'words_id']);
    }
}
