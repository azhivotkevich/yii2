<?php

namespace app\models\queries;

use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[\app\models\User]].
 *
 * @see \app\models\User
 */
class UsersQuery extends ActiveQuery
{
    public function doctors()
    {
        return $this
            ->innerJoin('auth_assignment', ['auth_assignment.user_id' => new Expression('users.id')])
            ->where(['auth_assignment.item_name' => 'doctor']);
    }
}
