<?php

namespace app\models\repository;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $text
 * @property int $task_id
 * @property int $autor_id
 * @property int $file_id
 * @property string $date_create
 * @property string $date_update
 *
 * @property Users $autor
 * @property Files $file
 * @property Tasks $task
 */
class Comments extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
    return 'comments';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
    return [
        [['text', 'task_id', 'autor_id'], 'required'],
        [['text'], 'string'],
        [['task_id', 'autor_id', 'file_id'], 'integer'],
        [['date_create', 'date_update'], 'safe'],
        [['autor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['autor_id' => 'id']],
        [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
        [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
    $langFile = 'app_comments';
    return [
        'id' => Yii::t($langFile, 'attribute_id'),
        'text' => Yii::t($langFile, 'attribute_text'),
        'task_id' => Yii::t($langFile, 'attribute_task_id'),
        'autor_id' => Yii::t($langFile, 'attribute_autor_id'),
        'file_id' => Yii::t($langFile, 'attribute_file_id'),
        'date_create' => Yii::t($langFile, 'attribute_date_create'),
        'date_update' => Yii::t($langFile, 'attribute_date_update'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getAutor()
  {
    return $this->hasOne(Users::className(), ['id' => 'autor_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getFile()
  {
    return $this->hasOne(Files::className(), ['id' => 'file_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getTask()
  {
    return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
  }
}
