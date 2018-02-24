<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "incomeGroup".
 *
 * @property integer $id
 * @property string $name
 */
class AccountGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accountGroup';
    }
    
    // связь таблицы для вытаскивания групп и доходов пользователя
    public function getAccount() {
        return $this->hasMany(account::className(), ['groupID' => 'id'])
                ->andOnCondition(['account.userID' => \Yii::$app->user->id]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
        ];
    }
}
