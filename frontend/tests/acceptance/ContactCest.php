<?php
namespace frontend\tests\functional;

use frontend\tests\AcceptanceTester;

/* @var $scenario \Codeception\Scenario */

class ContactCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/site/contact');
        $I->see('Contact', 'h1');
        $I->see('If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.', 'p');
       // $I->wait(5);
    }

    public function checkContactSubmitNoData(AcceptanceTester $I)
    {
        $I->submitForm('#contact-form', []);
        $I->wait(.2);
        $I->see('Name cannot be blank');
        $I->see('Email cannot be blank');
        $I->see('Subject cannot be blank');
        $I->see('Body cannot be blank');
        $I->see('The verification code is incorrect');
        $I->wait(0);
    }

    public function checkContactSubmitNoName(AcceptanceTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->wait(.2);
        $I->see('Name cannot be blank');
        $I->wait(5);
    }

    public function checkContactSubmitNoEmail(AcceptanceTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->wait(.2);
        $I->see('Email cannot be blank');
        $I->wait(5);
    }

    public function checkContactSubmitNoSubject(AcceptanceTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->wait(.2);
        $I->see('Subject cannot be blank');
        $I->wait(5);
    }

    public function checkContactSubmitNoBody(AcceptanceTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->wait(.2);
        $I->see('Body cannot be blank');
        $I->wait(5);
    }

    public function checkContactSubmitNoVerification(AcceptanceTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
        ]);
        $I->wait(.2);
        $I->see('The verification code is incorrect');
        $I->wait(5);
    }

    public function checkContactSubmitNotCorrectEmail(AcceptanceTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester.email',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->wait(.2);
        $I->see('Email is not a valid email address.');        
        // $I->dontSee('Name cannot be blank');
        // $I->dontSee('Subject cannot be blank');
        // $I->dontSee('Body cannot be blank');
        // $I->dontSee('The verification code is incorrect');
    }

    public function checkContactSubmitCorrectData(AcceptanceTester $I)
    {
        $I->submitForm('#contact-form', [
            'ContactForm[name]' => 'tester',
            'ContactForm[email]' => 'tester@example.com',
            'ContactForm[subject]' => 'test subject',
            'ContactForm[body]' => 'test content',
            'ContactForm[verifyCode]' => 'testme',
        ]);
        $I->wait(.2);
        // $I->seeEmailIsSent();
        $I->wait(5);
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');
        
    }
}
