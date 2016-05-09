Feature: In order to see if the testing framework is working I have created these basic tests for the
  homepage

  Scenario: Home Page Test
    When I should be able to do something with Laravel
    When I am on the homepage
    Then I am on "/login"
    Then I should see "Login"