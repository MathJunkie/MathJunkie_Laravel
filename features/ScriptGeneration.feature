Feature: The Script can be generated from the SageMathBlocks
  Scenario:
    Given I am on "/login"
    When I fill in "email" with "admin@bomberus.de"
    When I fill in "pass" with "admin"
    When I am on "/script/1"
    When I press "Save"
    When I am on "/script/1/view"
    Then I will see ResultPage