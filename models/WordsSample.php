<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "words_sample".
 *
 * @property int $id
 * @property int|null $words_id
 * @property string|null $description_uz
 * @property string|null $description_ru
 * @property string|null $description_eng
 * @property int|null $status
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Words $words
 */
class WordsSample extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'words_sample';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['words_id', 'status'], 'integer'],
            [['description_uz', 'description_ru', 'description_eng'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
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
            'description_uz' => Yii::t('app', 'Description Uz'),
            'description_ru' => Yii::t('app', 'Description Ru'),
            'description_eng' => Yii::t('app', 'Description Eng'),
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
