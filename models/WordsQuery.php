<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Words]].
 *
 * @see Words
 */
class WordsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Words[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Words|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
