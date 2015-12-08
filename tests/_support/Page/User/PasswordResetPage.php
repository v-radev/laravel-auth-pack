<?php namespace Page\User;

use AcceptanceTester;

class PasswordResetPage
{
    public static $ROUTE = 'auth.password';

    public static $formId = '#password-reset-form';

    public static $submit = 'Send Password Reset Link';

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

        $I->amOnRoute( static::$ROUTE );
        $I->see('Reset Password');
        $I->see('E-Mail Address:');
        $I->submitForm(static::$formId, [], static::$submit);
    }

}
