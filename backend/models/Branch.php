<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "branch".
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $address
 * @property string $date_created
 * @property int $status
 *
 * @property Company $company
 * @property Department[] $departments
 */
class Branch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'branch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'status'], 'integer'],
            [['date_created'], 'safe'],
            [['name', 'address'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'address' => 'Address',
            'date_created' => 'Date Created',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['branch_id' => 'id']);
    }
}
