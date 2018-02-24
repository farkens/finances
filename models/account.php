<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "income".
 *
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property integer $userID
 */
class account extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'account';
    }
    
    // связь таблицы для вытаскивания групп
    public function getGroup() {
        return $this->hasOne(AccountGroup::className(), ['id' => 'groupID']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'userID'], 'required'],
            [['price', 'userID'], 'integer'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'userID' => 'User ID',
        ];
    }
}
