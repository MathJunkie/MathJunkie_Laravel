Feature: In order to see the register function is working and the datas are saved in the database

  Scenario:  Successful Register
    Given I am on "/register"
    Given I should see "Email"
    Given I should see "Username"
    Given I should see "Password"
    Given I should see "Repeat Password"
    Given I should see "REGISTER"
    When I fill in "email" with "Max.Mustermann0@muster.com"
    When I fill in "name" with "Max"
    When I fill in "password" with "1234"
    When I fill in "password_confirmation" with "1234"
    When I press "register"
    Then I am on "/auth/register"