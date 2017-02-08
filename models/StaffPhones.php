<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%staff_phones}}".
 *
 * @property integer $id
 * @property integer $staff__id
 * @property integer $phones__id
 *
 * @property Phones $phones
 * @property Staff $staff
 */
class StaffPhones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%staff_phones}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff__id', 'phones__id'], 'integer'],
            [['staff__id', 'phones__id'], 'unique', 'targetAttribute' => ['staff__id', 'phones__id'], 'message' => 'The combination of Staff  ID and Phones  ID has already been taken.'],
            [['phones__id'], 'exist', 'skipOnError' => true, 'targetClass' => Phones::className(), 'targetAttribute' => ['phones__id' => 'id']],
            [['staff__id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['staff__id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'staff__id' => 'Staff  ID',
            'phones__id' => 'Phones  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasOne(Phones::className(), ['id' => 'phones__id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff__id']);
    }
}
