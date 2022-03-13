<?php

namespace tests\unit\auth;

use api\forms\auth\SignupForm;
use tests\unit\BaseUnitTest;

final class SignupFormTest extends BaseUnitTest
{
    public function testValid()
    {
        $form = new SignupForm([
            'email' => $this->faker()->email(),
            'name' => $this->faker()->name(),
            'password' => $this->faker()->password()
        ]);
        $result = $form->run();
        $this->assertTrue($result->isSuccessful());
        $this->assertNull($result->getException());
        $this->assertEmpty($result->getErrors());
        $this->assertNull($result->getData());
    }
}
