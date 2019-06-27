<?php
namespace frontend\tests\unit\models;


use Yii;
use common\models\Loginform;
use common\models\User;
use common\fixtures\UserFixture;

class loginForm1 extends \Codeception\Test\Unit
{
    public function testWrongUser()
    {
        $model = new LoginForm();

        $model->attributes = [
            'username' => 'maewmiie6',
            'password' => '123456',
        ];

       expect('model should not login user', $model->login())->false();
   
    }

    public function testCorrectUser()
    {
        $model = new LoginForm();
        $model->attributes = [
            'username' => 'maewmiie2',
            'password' => '123456',
        ];
        expect('model should not login user', $model->login())->true();
    }
    public function CorrectUserWrongPass()
    {
        $model = new LoginForm();
        $model->attributes = [
            'username' => 'maewmiie2',
            'password' => '123456',
        ];
        expect('model correct login user', $model->login())->false();
    }
    public function testFindToken()
    {
        $model = new User();
        $model->attributes = [
            'id' => 'maewmiie',
        ];

        expect('',$model->findIdentity($model->id));
    }
}
