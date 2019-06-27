<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->see('Congratulations!', 'h1');
        $I->seeLink('My Application');
    }

    public function checkLinkMyApplication(FunctionalTester $I)
    {
        $I->click('My Application');
        $I->see('Congratulations!', 'h1');
        $I->seeLink('My Application');
    }

    public function checkLinkHome(FunctionalTester $I)
    {
        $I->click('Home');
        $I->see('Congratulations!', 'h1');
        $I->seeLink('My Application');
    }

    public function checkLinkAbout(FunctionalTester $I)
    {
        $I->click('About');
        $I->see('About', 'h1');
    }

    public function checkLinkContact(FunctionalTester $I)
    {
        $I->click('Contact');
        $I->see('Contact', 'h1');
    }

    public function checkLinkSignup(FunctionalTester $I)
    {
        $I->click('Signup');
        $I->see('Signup', 'h1');
    }

    public function checkLinkLogin(FunctionalTester $I)
    {
        $I->click('Login');
        $I->see('Login', 'h1');
    }
}