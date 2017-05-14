<?php

use Behat\Behat\Context\Context;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends \samsonframework\behatextension\GenericFeatureContext  implements \tPayne\BehatMailExtension\Context\MailAwareContext
{

    use \tPayne\BehatMailExtension\Context\MailTrait;

    /**
     * @Given /^I am in a directory "([^"]*)"$/
     */
    public function iAmInADirectory($argument1)
    {
        $this->visitPath('/');
        $this->getSession()->wait(2000);
    }

    public function iAmOnHome()
    {
        $this->spin(function (FeatureContext $context) {
            $context->iAmOnHomepage();
            return true;
        });
    }

    /**
     * @Given I click on submit button
     */
    public function iClickOnSubmitButton()
    {
        $this->iClickOnTheElement('.btn.btn-primary');
        $this->iWaitMillisecondsForResponse();
    }

    /**
     * @Then I see error message
     */
    public function iSeeErrorMessage()
    {
        $this->spin(function (FeatureContext $context) {
            $context->assertElementOnPage('.help-block.help-block-error');
            return true;
        });
    }

    /**
     * @Given I follow confirmation link
     */
    public function followConfirmationLink()
    {
        $this->visitPath("/register/confirm/".$this->getUserManagerConfirmationToken()."/1");
        $this->iWaitMillisecondsForResponse(self::DELAY);
    }

    /**
     * @Then I should receive a welcome email
     */
    public function iShouldReceiveAWelcomeEmail()
    {
        $message = $this->mail->getLatestMessage();

        PHPUnit_Framework_Assert::assertEquals('Welcome', $message->subject());
        PHPUnit_Framework_Assert::assertContains('Please verify Your Email Address by clicking the button below.', $message->plainText());
    }
}
