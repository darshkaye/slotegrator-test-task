<?php

namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('admin');

        expect_not(User::findIdentity(999));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('admin'));
        expect_not(User::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('admin');
        expect_that($user->validateAuthKey('BD2hmoE_v9x3Tk503XMd9_tjfJy71Wc4'));
        expect_not($user->validateAuthKey('BD2hmoE_v9x3Tk503XMd9_tjfJy71Wc41'));

        expect_that($user->validatePassword('admin'));
        expect_not($user->validatePassword('admin1'));
    }

}
