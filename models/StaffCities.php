<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%staff_cities}}".
 *
 * @property integer $id
 * @property integer $staff__id
 * @property integer $cities__id
 *
 * @property Cities $cities
 * @property Staff $staff
 */
class StaffCities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%staff_cities}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff__id', 'cities__id'], 'integer'],
            [['cities__id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['cities__id' => 'id']],
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
            'cities__id' => 'Cities  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasOne(Cities::className(), ['id' => 'cities__id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff__id']);
    }
}
