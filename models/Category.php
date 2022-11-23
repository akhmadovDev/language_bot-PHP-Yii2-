<?php

namespace app\models;

use Yii;
use app\components\Keyboard;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $status
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Words[] $words
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['status', 'default', 'value' => Yii::$app->config::STATUS_ACTIVE],
            ['created_date', 'default', 'value' => Yii::$app->config::currentDateTime()],
            [['status'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
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
        return $this->hasMany(Words::class, ['category_id' => 'id']);
    }

    /**
     * Get category
     *
     * @param integer
     * @return array|Keyboard
     */
    public static function getAll(): array
    {
        $sql = <<<SQL
            SELECT * FROM category WHERE status = :status
        SQL;

        return Yii::$app
            ->db
                ->createCommand($sql, [':status' => Yii::$app->config::STATUS_ACTIVE])
            ->queryAll();
    }

    /**
     * Kategoriya id sini qaytaradi
     * agar kategoriya id si bo'lmada false qasytaradi
     *
     * @param string $category_name
     * @return int|bool
     */
    public static function getId(string $category_name): int|bool
    {
        $sql = <<<SQL
            SELECT `id` FROM category WHERE name = :name
        SQL;

        $result = Yii::$app->db->createCommand($sql, [':name' => $category_name])->queryOne();

        if ($result === false) {
            return false;
        }

        return $result['id'];
    }
}