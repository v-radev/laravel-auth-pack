<?php namespace Page\User;

use AcceptanceTester;

class PasswordChangePage
{
    public static $PAGE = '/auth/reset/x';

    public static $PAGE_PLAIN = '/auth/reset/';

    public static $formId = '#password-change-form';

    public static $submit = 'Reset password';

    /**
     * @var AcceptanceTester
     */
    protected $tester;


    public function __construct(AcceptanceTester $I)
    {
        $this->tester = $I;
    }


    public function validateForm()
    {
        $I = $this->tester;

        $I->amOnPage( static::$PAGE);
        $I->see('Please fill the fields to reset your password.');
        $I->see('E-Mail Address:');
        $I->see('New Password:');
        $I->see('Confirm Password:');
        $I->submitForm(static::$formId, [], static::$submit);
    }

}
