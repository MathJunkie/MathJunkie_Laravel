Feature: In order to see the login function is working and the datas are saved in the database

  Scenario:  Successful Login
    When I am on "/login"
    Then I should see "Email"
    And I should see "Password"
    And I should see "Remember me"
    And I should see "LOGIN"
    And I should see "Register Now!"
    And I should see "Forgot password ?"
    When I fill in "email" with "Max.Mustermann@muster.com"
    And I fill in "password" with "1234"
    And I press "login"
    Then I am on "/auth/login"

