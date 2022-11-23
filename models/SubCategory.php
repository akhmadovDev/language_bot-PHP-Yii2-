<?php

namespace app\models;

use app\components\Config;
use app\components\Keyboard;
use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $id
 * @property int|null $category_id
 * @property string|null $name
 * @property string $created_date
 * @property string $updated_date
 *
 * @property Category $category
 * @property Words[] $words
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'created_date' => Yii::t('app', 'Created Date'),
            'updated_date' => Yii::t('app', 'Updated Date'),
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Words]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWords()
    {
        return $this->hasMany(Words::class, ['sub_category_id' => 'id']);
    }

    /**
     * Subkategoriyani qaytraradi
     * agar ma'lumot mavjud bo'lmasa [] qaytaradi
     *
     * @param string $category_id
     * @return array
     */
    public static function getAll(string $category_id): array
    {
        $sql = <<<SQL
            SELECT * FROM sub_category WHERE category_id = :category_id AND status = :status
        SQL;

        return Yii::$app
            ->db->createCommand($sql, [
                ':category_id' => $category_id,
                ':status' => Config::STATUS_ACTIVE
            ])->queryAll();
    }

    /**
     * Undocumented function
     *
     * @param string $sub_category_name
     * @return integer|null
     */
    public static function getId(string $sub_category_name): ?int
    {
        $sql = <<<SQL
            SELECT * FROM sub_category WHERE status = :status AND name = :name 
        SQL;

        $sub_category = Yii::$app->db->createCommand($sql, [
            ':status' => Config::STATUS_ACTIVE,
            ':name' => $sub_category_name
        ])->queryOne();

        if ($sub_category === false) {
            return null;
        }

        return $sub_category['id'];
    }
}