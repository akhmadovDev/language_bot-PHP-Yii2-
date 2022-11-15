<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "words_audio".
 *
 * @property int $id
 * @property int|null $words_id
 * @property string|null $audio
 * @property int|null $status
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Words $words
 */
class WordsAudio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'words_audio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['words_id', 'status'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['audio'], 'string', 'max' => 255],
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
            'audio' => Yii::t('app', 'Audio'),
            'status' => Yii::t('app', 'Status'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
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
