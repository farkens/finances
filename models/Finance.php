<?php

namespace app\models;


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
class Finance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'finance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'comment', 'sum', 'date', 'accountID'], 'required'],
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
