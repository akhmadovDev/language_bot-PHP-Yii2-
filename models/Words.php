<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "words".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $title_uz
 * @property string|null $title_ru
 * @property string|null $title_eng
 * @property int|null $status
 * @property string $created_date
 * @property string $updated_date
 *
 * @property SubCategory $subCategory
 * @property Test[] $tests
 * @property WordsAudio[] $wordsAudios
 * @property WordsSample[] $wordsSamples
 */
class Words extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'words';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sub_category_id', 'title_uz', 'title_eng'], 'required'],
            [['sub_category_id', 'status'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['title_uz', 'title_ru', 'title_eng'], 'string', 'max' => 255],
            [['sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::class, 'targetAttribute' => ['sub_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'title_uz' => Yii::t('app', 'Title Uz'),
            'title_ru' => Yii::t('app', 'Title Ru'),
            'title_eng' => Yii::t('app', 'Title Eng'),
            'status' => Yii::t('app', 'Status'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(SubCategory::class, ['id' => 'sub_category_id']);
    }

    /**
     * Gets query for [[Tests]].
     *
     * @return \yii\db\ActiveQuery|TestQuery
     */
    public function getTests()
    {
        return $this->hasMany(Test::class, ['words_id' => 'id']);
    }

    /**
     * Gets query for [[WordsAudios]].
     *
     * @return \yii\db\ActiveQuery|WordsAudioQuery
     */
    public function getWordsAudios()
    {
        return $this->hasMany(WordsAudio::class, ['words_id' => 'id']);
    }

    /**
     * Gets query for [[WordsSamples]].
     *
     * @return \yii\db\ActiveQuery|WordsSampleQuery
     */
    public function getWordsSamples()
    {
        return $this->hasMany(WordsSample::class, ['words_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return WordsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WordsQuery(get_called_class());
    }
}
