<?php

namespace frontend\tests\functional;

use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class VerifyEmailCest
{

    public function checkEmptyToken(FunctionalTester $I)
    {
        $I->amOnRoute('site/verify-email', ['token' => '']);
        $I->canSee('Bad Request', 'h1');
        $I->canSee('Verify email token cannot be blank.');
    }

    public function checkInvalidToken(FunctionalTester $I)
    {
        $I->amOnRoute('site/verify-email', ['token' => 'wrong_token']);
        $I->canSee('Bad Request', 'h1');
        $I->canSee('Wrong verify email token.');
    }

    public function checkNoToken(FunctionalTester $I)
    {
        $I->amOnRoute('site/verify-email');
        $I->canSee('Bad Request', 'h1');
        $I->canSee('Missing required parameters: token');
    }

    public function checkAlreadyActivatedToken(FunctionalTester $I)
    {
        $I->amOnRoute('site/verify-email', ['token' => 'already_used_token_1548675330']);
        $I->canSee('Bad Request', 'h1');
        $I->canSee('Wrong verify email token.');
    }

    public function checkSuccessVerification(FunctionalTester $I)
    {
        $I->amOnRoute('site/verify-email', ['token' => 'rGK6lWpg_Tmqj1kpOE4pyj5e3uWKhoHm_1561430662']);
        $I->canSee('Your email has been confirmed!');
        $I->canSee('Congratulations!', 'h1');
        $I->see('Logout (jon@mail.com)', 'form button[type=submit]');

        $I->seeRecord('common\models\User', [
           'username' => 'jon@mail.com',
           'email' => 'jon@mail.com',
           'status' => \common\models\User::STATUS_ACTIVE
        ]);
    }
}
