<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persons".
 *
 * @property int $Personid
 * @property string $LastName
 * @property string|null $FirstName
 * @property int|null $Age
 */
class Proflie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LastName'], 'required'],
            [['Age'], 'integer'],
            [['LastName', 'FirstName'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Personid' => 'Personid',
            'LastName' => 'Last Name',
            'FirstName' => 'First Name',
            'Age' => 'Age',
        ];
    }
}
