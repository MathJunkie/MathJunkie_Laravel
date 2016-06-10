Feature: Solution Calculation
  Scenario: The user wants to calculate a given script with his own input
    Given I am on ScriptPage
    Given I filled in "input" with "20"
    When I click on "calculate"
    Then I will see ResultPage

  Scenario: There is an error in the backend
    Given I am on ScriptPage
    Given I filled in "input" with "--"
    When I click on "calculate "
    Then I will see ErrorPage