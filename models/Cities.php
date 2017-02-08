<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cities}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $zip_code
 * @property string $created_at
 * @property string $updated_at
 *
 * @property StaffCities[] $staffCities
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cities}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['zip_code'], 'string', 'max' => 10],
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
            'zip_code' => 'Zip Code',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffCities()
    {
        return $this->hasMany(StaffCities::className(), ['cities__id' => 'id']);
    }
}
