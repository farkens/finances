<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "income".
 *
 * @property integer $id
 * @property string $name
 * @property string $comment
 * @property string $sum
 * @property string $date
 * @property integer $userID
 * @property integer $accountID
 */
class Income extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'income';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'comment', 'sum', 'date', 'userID', 'accountID'], 'required'],
            [['sum'], 'number'],
            [['date'], 'safe'],
            [['userID', 'accountID'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 255],
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
            'comment' => 'Comment',
            'sum' => 'Sum',
            'date' => 'Date',
            'userID' => 'User ID',
            'accountID' => 'Account ID',
        ];
    }
}
