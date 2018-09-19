<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property int $branch_id
 * @property string $name
 * @property int $company_id
 * @property string $date_created
 * @property int $status
 *
 * @property Branch $branch
 * @property Company $company
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['branch_id', 'company_id', 'status'], 'integer'],
            [['name', 'status'], 'required'],
            [['date_created'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branch::className(), 'targetAttribute' => ['branch_id' => 'id']],
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
            'branch_id' => 'Branch ID',
            'name' => 'Name',
            'company_id' => 'Company ID',
            'date_created' => 'Date Created',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
