Feature: 1. The user should create an account
         2. The user will be logged in and should logout
         3. The user tries to manually login again

  Scenario:
    Given I am on "/register"
    When I fill in "email" with "test@testi.com"
    When I fill in "name" with "test"
    When I fill in "pass1" with "testtest"
    When I fill in "pass2" with "testtest"
    When I press "register"
    Then I am on "/admin"

  Scenario:
    Given I am on "/admin"
    When I am on "/auth/logout"
    Then I am on "/login"
