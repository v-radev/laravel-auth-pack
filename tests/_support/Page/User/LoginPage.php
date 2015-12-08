<?php namespace Page\User;

use AcceptanceTester;

class LoginPage
{
    public static $ROUTE = 'auth.login';

    public static $formId = '#login-form';

    public static $maxLoginAttempts = 4;

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
        $I->see('Username:');
        $I->see('Password:');
        $I->see('Remember me:');
        $I->see('Forgot Your Password?', 'a');
        $I->submitForm(static::$formId, [], 'Login');
    }

}
