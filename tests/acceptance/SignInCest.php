<?php

class SignInCest
{
    const SIGNIN_PATH = '/security/signin';
    
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function signInPageShouldExist(AcceptanceTester $I)
    {
        $I->amOnPage(self::SIGNIN_PATH);
    }
}
