<?php

class AuthManagerController extends Controller {
    public function actionIndex(){
        $auth = Yii::app()->authManager;
        
        if ($auth !== NULL){
            $auth->clearAll();
            //create roles
            $roleOwner = $auth->createRole('owner');
            $roleReader = $auth->createRole('reader');
            $roleMember = $auth->createRole('member');
            $roleBlackList = $auth->createRole('blackList');

            //create operations
            //issues
            $auth->createOperation('createIssue', 'create issue in project');
            $auth->createOperation('readIssue', 'read issue');
            $auth->createOperation('updateIssue', 'update issue');
            $auth->createOperation('deleteIssue', 'delete issue');

            //projects
            $auth->createOperation('createProject', 'create a new project');
            $auth->createOperation('readProject', 'read project');
            $auth->createOperation('updateProject', 'update project');
            $auth->createOperation('deleteProject', 'delete project');

            //users
            $auth->createOperation('createUser', 'create a new user');
            $auth->createOperation('readUser', 'read user');
            $auth->createOperation('updateUser', 'update user');
            $auth->createOperation('deleteUser', 'delete user');

            //authorization
            $roleReader->addChild('readIssue');
            $roleReader->addChild('readProject');
            $roleReader->addChild('readUser');

            $roleMember->addChild('reader');
            $roleMember->addChild('createIssue');
            $roleMember->addChild('updateIssue');
            $roleMember->addChild('deleteIssue');

            $roleOwner->addChild('reader');
            $roleOwner->addChild('member');
            $roleOwner->addChild('createProject');
            $roleOwner->addChild('updateProject');
            $roleOwner->addChild('deleteProject');
            $roleOwner->addChild('createUser');
            $roleOwner->addChild('updateUser');
            $roleOwner->addChild('deleteUser');

            //assign
            //此时，在Issue中的rules中设置view和index的roles=>array('member'),不管是什么用户，都无法访问这两个action
            $userAdmin = User::model()->findByAttributes(array('username' => 'admin'));
            $auth->assign('owner', $userAdmin->id);
            $auth->assign('member', $userAdmin->id); //将用户名为admin（id=3）指定为member角色，这样就可以访问了。
            $auth->assign('reader', $userAdmin->id);

            $userDemo = User::model()->findByAttributes(array('username' => 'demo'));
            $auth->assign('member', $userDemo->id); //将用户名为admin（id=3）指定为member角色，这样就可以访问了。
            $auth->assign('reader', $userDemo->id); //将用户名为demo（id=4）指定为reader角色
            
            $userDemo2 = User::model()->findByAttributes(array('username' => 'demo2'));
            $auth->assign('reader', $userDemo2->id); //将用户名为demo（id=4）指定为reader角色

            $userBlackList = User::model()->findByAttributes(array('username' => 'demo3'));
            $auth->assign('blackList', $userBlackList->id);
        }else{
            $message = 'Please config your authManage as a compontion in main.php';
            throw new CHttpException(0, $message);
        }
    }
}