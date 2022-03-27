<?php

namespace tests\unit\auth;

use api\forms\auth\SignupForm;
use tests\unit\BaseUnitTest;

final class SignupFormTest extends BaseUnitTest
{
    public function testEmpty()
    {
        $form = new SignupForm();
        $result = $form->run();
        $this->assertExecutionResultErrors(
            result: $result,
            errorKeys: ['email', 'name', 'password']
        );
    }

    public function testEmail()
    {
        $form = new SignupForm(['email' => $this->getFaker()->email()]);
        $result = $form->run();
        $this->assertExecutionResultErrors(
            result: $result,
            errorKeys: ['name', 'password'],
            noErrorKeys: ['email']
        );
    }

    public function testExistingEmail()
    {
        $user = $this->getFaker()->user();
        $form = new SignupForm(['email' => $user->getEmail()]);
        $result = $form->run();
        $this->assertExecutionResultErrors(
            result: $result,
            errorKeys: ['email', 'name', 'password']
        );
    }

    public function testName()
    {
        $form = new SignupForm(['name' => $this->getFaker()->name()]);
        $result = $form->run();
        $this->assertExecutionResultErrors(
            result: $result,
            errorKeys: ['email', 'password'],
            noErrorKeys: ['name']
        );
    }

    public function testPassword()
    {
        $form = new SignupForm(['password' => $this->getFaker()->password()]);
        $result = $form->run();
        $this->assertExecutionResultErrors(
            result: $result,
            errorKeys: ['email', 'name'],
            noErrorKeys: ['password']
        );
    }

    public function testValid()
    {
        $form = new SignupForm([
            'email' => $this->getFaker()->email(),
            'name' => $this->getFaker()->name(),
            'password' => $this->getFaker()->password()
        ]);
        $result = $form->run();
        $this->assertExecutionResultSuccessful($result);
        $this->assertNotNull($result->getData('tokens.access'));
        $this->assertNotNull($result->getData('tokens.refresh'));
    }
}
