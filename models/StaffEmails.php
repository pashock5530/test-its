<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%staff_emails}}".
 *
 * @property integer $id
 * @property integer $staff__id
 * @property integer $emails__id
 *
 * @property Emails $emails
 * @property Staff $staff
 */
class StaffEmails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%staff_emails}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['staff__id', 'emails__id'], 'integer'],
            [['staff__id', 'emails__id'], 'unique', 'targetAttribute' => ['staff__id', 'emails__id'], 'message' => 'The combination of Staff  ID and Emails  ID has already been taken.'],
            [['emails__id'], 'exist', 'skipOnError' => true, 'targetClass' => Emails::className(), 'targetAttribute' => ['emails__id' => 'id']],
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
            'emails__id' => 'Emails  ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmails()
    {
        return $this->hasOne(Emails::className(), ['id' => 'emails__id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff__id']);
    }
}
