<?php

use Actors\UserActor;
use Page\User\PasswordResetPage;
use Page\User\PasswordChangePage;


class ResetAcceptanceCest//Moved to functional
{

//    /**
//     * @var UserActor
//     */
//    protected $userActor;
//
//
//    public function __construct()
//    {
//        $this->userActor = new UserActor();
//    }
//
//
//    public function it_has_password_reset_form( AcceptanceTester $I )
//    {
//        $passwordResetPage = new PasswordResetPage($I);
//        $passwordResetPage->validateForm();
//    }
//
//    public function it_validates_required_password_reset_form_email_field( AcceptanceTester $I )
//    {
//        $I->amOnRoute(PasswordResetPage::$ROUTE);
//        $I->submitForm(PasswordResetPage::$formId, [], PasswordResetPage::$submit);
//        $I->see('The email field is required.');
//    }
//
//    public function it_outputs_error_on_non_existing_email_for_password_reset_form( AcceptanceTester $I )
//    {
//        $I->amOnRoute(PasswordResetPage::$ROUTE);
//
//        $I->fillField('email', UserActor::$_nonExistingEmail);
//        $I->submitForm(PasswordResetPage::$formId, [], PasswordResetPage::$submit);
//
//        $I->see('This e-mail does not exist in our database.');
//    }
//
//    public function it_successfully_sends_password_reset_mail_link( AcceptanceTester $I )
//    {
//        $I->amOnRoute(PasswordResetPage::$ROUTE);
//
//        $I->fillField('email', 'email@example.com');
//        $I->submitForm(PasswordResetPage::$formId, [], PasswordResetPage::$submit);
//
//        $I->see('Reset link was successfully sent. Please check your email.');
//        $I->seeRecord('password_resets', ['email' => 'email@example.com']);
//    }
//
////PASSWORD CHANGE FORM
//
//    public function it_has_password_change_form( AcceptanceTester $I )
//    {
//        $passwordChangePage = new PasswordChangePage($I);
//        $passwordChangePage->validateForm();
//    }
//
//    public function it_validates_required_password_change_form_email_field( AcceptanceTester $I )
//    {
//        $I->amOnPage(PasswordChangePage::$PAGE);
//
//        $I->submitForm(PasswordChangePage::$formId, [], PasswordChangePage::$submit);
//        $I->see('The email field is required.');
//    }
//
//    public function it_validates_required_password_change_form_password_field( AcceptanceTester $I )
//    {
//        $I->amOnPage(PasswordChangePage::$PAGE);
//
//        $I->fillField('email', UserActor::$_nonExistingEmail);
//        $I->submitForm(PasswordChangePage::$formId, [], PasswordChangePage::$submit);
//
//        $I->see('The password field is required.');
//    }
//
//    public function it_validates_matching_password_change_form_password_confirmation_field( AcceptanceTester $I )
//    {
//        $I->amOnPage(PasswordChangePage::$PAGE);
//
//        $I->fillField('email', UserActor::$_nonExistingEmail);
//        $I->fillField('password', 'yes');
//
//        $I->submitForm(PasswordChangePage::$formId, [], PasswordChangePage::$submit);
//
//        $I->see('The password confirmation does not match.');
//    }
//
//    public function it_outputs_error_on_non_matching_email_reset_request_for_password_change_form( AcceptanceTester $I )
//    {
//        $I->amOnPage(PasswordChangePage::$PAGE);
//
//        $I->fillField('email', UserActor::$_nonExistingEmail);
//        $I->fillField('password', 'yes');
//        $I->fillField('password_confirmation', 'yes');
//        $I->submitForm(PasswordChangePage::$formId, [], PasswordChangePage::$submit);
//
//        //The used email should exist in the DB as a request for password change. The email above is not such an email, so validation should kick in.
//        $I->see('This is not a valid request for password reset.');
//    }
//
//    public function it_validates_password_length_for_password_change_form( AcceptanceTester $I )
//    {
//        $email = 'email@example.com';//Existing record in DB
//        $resetRecord = $I->grabRecord('password_resets', ['email' => $email] );
//
//        $I->amOnPage(PasswordChangePage::$PAGE_PLAIN . $resetRecord->token);
//
//        $I->fillField('email', $email);
//        $I->fillField('password', 'yes');
//        $I->fillField('password_confirmation', 'yes');
//        $I->submitForm(PasswordChangePage::$formId, [], PasswordChangePage::$submit);
//
//        $I->see('Password must be at least 6 characters.');
//    }
//
//    public function it_successfully_changes_password_from_password_change_form( AcceptanceTester $I )
//    {
//        $email = 'email@example.com';//Existing record in DB
//        $resetRecord = $I->grabRecord('password_resets', ['email' => $email] );
//
//        $I->amOnPage(PasswordChangePage::$PAGE_PLAIN . $resetRecord->token);
//
//        $I->fillField('email', $email);
//        $I->fillField('password', '123456');
//        $I->fillField('password_confirmation', '123456');
//        $I->submitForm(PasswordChangePage::$formId, [], PasswordChangePage::$submit);
//
//        $I->see('Password successfully reset. You can now login.');
//    }

}
