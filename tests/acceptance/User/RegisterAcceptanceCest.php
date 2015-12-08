<?php

use Page\User\RegisterPage;


class RegisterAcceptanceCest
{

    public function it_has_register_form( AcceptanceTester $I )
    {
        $registerPage = new RegisterPage($I);
        $registerPage->validateForm();
    }

    public function it_validates_required_fields( AcceptanceTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The username field is required.');
        $I->see('The email field is required.');
        $I->see('The password field is required.');
        $I->dontSee('The name field is required.');
    }

    public function it_validates_username_length( AcceptanceTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('username', 'a');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The username must be at least 4 characters.');

        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('username', 'abcdefghijabcdefghija');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The username may not be greater than 20 characters.');
    }

    public function it_validates_username_regex ( AcceptanceTester $I )
    {
        //^[a-z][a-z\d_.]+$

        //Big letters
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('username', 'A');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The username format is invalid.');

        //Starts with letter
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('username', '1');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The username format is invalid.');

        //No space
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('username', 'a s');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The username format is invalid.');

        //Can have digit
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('username', 'a1s');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->dontSee('The username format is invalid.');

        //Can have symbols
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('username', 'a_.s');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->dontSee('The username format is invalid.');
    }

    public function it_validates_email ( AcceptanceTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('email', 'abcd');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The email must be a valid email address.');
    }

    public function it_validates_password_length( AcceptanceTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('password', 'a');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The password must be at least 6 characters.');
    }

    public function it_confirms_password( AcceptanceTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('password', '123456');
        $I->fillField('password_confirmation', '123455');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The password confirmation does not match.');
    }

    public function it_validates_name_length ( AcceptanceTester $I )
    {
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField('name', 'a');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see('The name must be at least 3 characters.');
        $I->seeResponseCodeIs(200);
    }

    public function it_validates_name_regex ( AcceptanceTester $I )
    {
        //^[A-Za-z]'?[-\. a-zA-Z]+$
        $field = 'name';
        $error = 'The name format is invalid.';

        //Starts with letter
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField($field, '1');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->see($error);

        //Can have space
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField($field, 'aa aa');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->dontSee($error);

        //Can have symbols
        $I->amOnRoute( RegisterPage::$ROUTE);
        $I->fillField($field, 'aa-.');
        $I->submitForm(RegisterPage::$formId, [], 'Register');
        $I->dontSee($error);
    }

    public function it_registers_successfully ( AcceptanceTester $I )
    {
        $userActor = new \Actors\UserActor;

        $I->amOnRoute( RegisterPage::$ROUTE);
        $userActor->fillRegisterPageFields($I);
        $I->submitForm(RegisterPage::$formId, [], 'Register');

        $I->see('View profile');
        $I->see('Edit profile');
        $I->see('Logout');
    }
}
