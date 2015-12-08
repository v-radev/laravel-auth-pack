<?php namespace Page\User;

use AcceptanceTester;

class RegisterPage
{
    public static $ROUTE = 'auth.register';

    public static $formId = '#register-form';

    /**
     * @var AcceptanceTester
     */
    protected $tester;



    public function __construct(AcceptanceTester $I)
    {
        $this->tester = $I;
    }


    public static function route($param)
    {
        return static::$ROUTE.$param;
    }

    public function validateForm()
    {
        $I = $this->tester;

        $I->amOnRoute( static::$ROUTE );
        $I->see('Username:');
        $I->see('Can contain only lowercase letters, numbers, underscore and period.');
        $I->see('E-Mail Address:');
        $I->see('Name:');
        $I->see('Can contain only letters, space, dash, apostrophe and period.');
        $I->see('Password:');
        $I->see('Confirm Password:');
        $I->submitForm(static::$formId, [], 'Register');
    }

}
