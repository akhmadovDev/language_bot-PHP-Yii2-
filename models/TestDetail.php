<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test_detail".
 *
 * @property int $id
 * @property int|null $test_id
 * @property int|null $attemp
 * @property string $created_date
 */
class TestDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'test_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test_id', 'attemp'], 'integer'],
            [['created_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'test_id' => Yii::t('app', 'Test ID'),
            'attemp' => Yii::t('app', 'Attemp'),
            'created_date' => Yii::t('app', 'Created Date'),
        ];
    }
}
