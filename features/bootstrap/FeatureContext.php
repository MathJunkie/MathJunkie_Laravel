<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit_Framework_Assert as PHPUnit;
use Laracasts\Behat\Context\Migrator;
use Laracasts\Behat\Context\DatabaseTransactions;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    /**
     * @Then I should be able to do something with Laravel
     */
    public function iShouldBeAbleToDoSomethingWithLaravel()
    {
        $environmentFileName = app()->environmentFile();
        $environmentName = env('APP_ENV');
        //PHPUnit::assertEquals('.env.old.behat', $environmentFileName);
        //PHPUnit::assertEquals('acceptance', $environmentName);
    }

    /**
     * @Given /^I am on ScriptPage$/
     */
    public function iAmOnScriptPage()
    {
        $this->visitPath('/script/1/view');
    }

    /**
     * @Given /^I filled in "([^"]*)" with "([^"]*)"$/
     */
    public function iFilledInWith($arg1, $arg2)
    {
        $sagecell = $this->getSession()->getPage()->findById('ergebnis');

        if (null !== $sagecell) {
            throw new \Exception('Sagecell computing not found');
        }

        $sagecel = $arg1 + $arg2;

    }

    /**
     * @When /^I click on "([^"]*)"$/
     */
    public function iClickOn($arg1)
    {
        $btn = $arg1;
        $btn = 'dropdown_user';

        $button = $this->getSession()->getPage()->findById($btn);

        if (null !== $button) {
            throw new \Exception('Button not found');
        }
    }

    /**
     * @Then /^I will see ResultPage$/
     */
    public function iWillSeeResultPage()
    {
        $error = $this->getSession()->getPage()->findById('ErrorMessage');

        if (null === $error) {
            return true;
        }

    }

    /**
     * @Then /^I will see ErrorPage$/
     */
    public function iWillSeeErrorPage()
    {
        $result = $this->getSession()->getPage()->findById('ResultMessage');

        if (null === $result) {
            return true;
        }
    }

    /**
     * @Then /^I will see PrintButton$/
     */
    public function iWillSeePrintButton()
    {
        $btn = $this->getSession()->getPage()->findLink('.mdi-action-print');

        if ($btn !== null){
            return true;
        }
    }
}
