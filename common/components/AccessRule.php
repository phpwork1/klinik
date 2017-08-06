<?php
namespace common\components;

class AccessRule extends \yii\filters\AccessRule {
    /**
     * @inheritdoc
     */
    protected function matchRole($user) {
        //parent::matchRole($user);
        
        if (empty($this->roles)) {
            return TRUE;
        }
        
        foreach ($this->roles as $role) {
            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return TRUE;
                } 
            } elseif ($role === '@') {
                if ($user->getIsGuest()) {
                    return TRUE;
                } 
            } elseif (!$user->getIsGuest() && $role === $user->identity->role) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
}