Feature: test
  Background:
    Given I am on the homepage

  Scenario: User should be able to fill in all required fields and press submit
    And I fill in the input "#contactform-name" with "Test"
    And I fill in the input "#contactform-email" with "260ad9b0c2-0d945c@inbox.mailtrap.io"
    And I fill in the input "#contactform-subject" with "test"
    And I click on submit button
    And I wait "200" milliseconds for response
    And I am on "/site/thank-you"
    #Then I should receive a welcome email

   Scenario: User should see warning message if let name field blank and press submit
     Given I fill in the input "#contactform-email" with "codeception02@gmail.com"
     Given I fill in the input "#contactform-subject" with "test"
     And I click on submit button
     And I wait "200" milliseconds for response
     And I see error message

    Scenario: User should see warning message if let email field blank and press submit
      And I fill in the input "#contactform-name" with "Test"
      Given I fill in the input "#contactform-subject" with "test"
      And I click on submit button
      And I wait "200" milliseconds for response
      And I see error message

    Scenario: User should see warning message if let subject field blank and press submit
      And I fill in the input "#contactform-name" with "Test"
      Given I fill in the input "#contactform-email" with "codeception02@gmail.com"
      And I click on submit button
      And I wait "200" milliseconds for response
      And I see error message








