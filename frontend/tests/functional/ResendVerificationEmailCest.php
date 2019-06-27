<?php

namespace frontend\tests\functional;

use common\fixtures\UserFixture;
use common\models\User;
use frontend\tests\FunctionalTester;

class ResendVerificationEmailCest
{
    protected $formId = '#resend-verification-email-form';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('/site/resend-verification-email');
    }

    protected function formParams($email)
    {
        return [
            'ResendVerificationEmailForm[email]' => $email
        ];
    }

    public function checkPage(FunctionalTester $I)
    {
        $I->see('Resend verification email', 'h1');
        $I->see('Please fill out your email. A verification email will be sent there.');
    }

    public function checkEmptyField(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams(''));
        $I->seeValidationError('Email cannot be blank.');
    }

    public function checkWrongEmailFormat(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams('abcd.com'));
        $I->seeValidationError('Email is not a valid email address.');
    }

    public function checkWrongEmail(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams('wrong@email.com'));
        $I->seeValidationError('There is no user with this email address.');
    }

    public function checkAlreadyVerifiedEmail(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams('test2@mail.com'));
        $I->seeValidationError('There is no user with this email address.');
    }

    public function checkSendSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, $this->formParams('jon@mail.com'));
        $I->canSeeEmailIsSent();
        $I->seeRecord('common\models\User', [
            'email' => 'jon@mail.com',
            'username' => 'jon@mail.com',
            'status' => \common\models\User::STATUS_INACTIVE
        ]);
        $I->see('Check your email for further instructions.');
    }
}
