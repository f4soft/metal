<?php
namespace app\commands;

use app\models\User;
use \app\rbac\UserGroupRule;
use Yii;
use yii\console\Controller;
use yii\base\InvalidParamException;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;
        $authManager->removeAll();
        // Create roles
        $guest = $authManager->createRole('guest');
        $user = $authManager->createRole('user');
        $admin = $authManager->createRole('admin');

        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $authManager->add($userGroupRule);

        // Add rule "UserGroupRule" in roles
        $guest->ruleName = $userGroupRule->name;
        $user->ruleName = $userGroupRule->name;
        $admin->ruleName = $userGroupRule->name;

        // Add roles in Yii::$app->authManager
        $authManager->add($guest);
        $authManager->add($user);
        $authManager->add($admin);

        // add "adminAccess" permission
        $adminAccess = $authManager->createPermission('adminAccess');
        $adminAccess->description = 'Access to site admin panel';
        $authManager->add($adminAccess);

        // give admin role the "adminAccess" permission
        $authManager->addChild($admin, $adminAccess);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        // $auth->assign($admin, 5);
    }

//    public function actionAssign($role, $email)
//    {
//        $user = User::find()->where(['email' => $email])->one();
//        if (!$user) {
//            throw new InvalidParamException("There is no user with email \"$email\".");
//        }
//
//        $auth = Yii::$app->authManager;
//        $roleObject = $auth->getRole($role);
//        if (!$roleObject) {
//            throw new InvalidParamException("There is no role \"$role\".");
//        }
//
//        $auth->assign($roleObject, $user->id);
//    }
}