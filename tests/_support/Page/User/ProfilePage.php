<?php namespace Page\User;

use AcceptanceTester;

class ProfilePage
{
    public static $formId = '#profile-form';


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

        $I->see('E-Mail Address:');
        $I->see('Name:');
        $I->see('New Password:');
        $I->see('Confirm New Password:');
        $I->submitForm(static::$formId, [], 'Update');
    }

}
