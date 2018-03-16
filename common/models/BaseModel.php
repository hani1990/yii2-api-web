<?php
/**
 * Created by PhpStorm.
 * User: liuhan
 * Date: 2017/12/29
 * Time: 下午2:13
 */

namespace common\models;


use yii\db\ActiveRecord;

class BaseModel extends ActiveRecord
{
    protected $_safe2array = [];
    const PAGESIZE = 10;

    /**
     * 获得当前时间
     * @return string
     */
    public static function getCurrentTime()
    {
        return self::getFormatTime(time());
    }

    /**
     * 获得指定格式的时间
     * @param $timestamp
     * @return bool|string
     */
    public static function getFormatTime($timestamp = '')
    {
        return date('Y-m-d H:i:s', $timestamp && is_numeric($timestamp) ? $timestamp : time());
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert && $this->hasAttribute('create_time')) {
            $this->setAttribute('create_time', self::getCurrentTime());
        }
        if ($this->hasAttribute('update_time')) {
            $this->setAttribute('update_time', self::getCurrentTime());
        }

        return parent::beforeSave($insert);
    }


    /**
     * 创建时间戳
     * @return int
     */
    public function getCreateTime()
    {
        return $this->hasAttribute('create_time') ? strtotime($this->getAttribute('create_time')) : 0;
    }


    /**
     * 更新时间戳
     * @return int
     */
    public function getUpdateTime()
    {
        return $this->hasAttribute('update_time') ? strtotime($this->getAttribute('update_time')) : 0;
    }

    /**
     * 指定可以展示的字段
     * @param array $fields
     * @return array
     */
    public function getSafe2array($fields = [])
    {
        if (empty($this->_safe2array)) {
            return [];
        }
        $safe = [];
        if (empty($fields))
            $fields = $this->_safe2array;
        foreach ($fields as $key) {
            if ($key && in_array($key, $this->_safe2array) && $this->hasProperty($key))
                $safe[$key] = $this->{$key};
        }
        return $safe;
    }

}