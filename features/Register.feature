Feature: In order to see the register function is working and the datas are saved in the database

  Scenario:  Successful Register
    When I am on "/register"
    Then I should see "Email"
    And I should see "Username"
    And I should see "Password"
    And I should see "Repeat Password"
    And I should see "REGISTER"
    When I fill in "email" with "Max.Mustermann0@muster.com"
    And I fill in "name" with "Max"
    And I fill in "password" with "1234"
    And I fill in "password_confirmation" with "1234"
    And I press "register"
    Then I am on "/auth/register"