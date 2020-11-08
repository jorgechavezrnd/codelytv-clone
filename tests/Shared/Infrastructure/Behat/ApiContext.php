<?php

declare(strict_types = 1);

namespace CodelyTv\Tests\Shared\Infrastructure\Behat;

use Behat\Gherkin\Node\PyStringNode;
use Behat\Mink\Session;
use Behat\MinkExtension\Context\RawMinkContext;
use CodelyTv\Tests\Shared\Infrastructure\Mink\MinkHelper;
use CodelyTv\Tests\Shared\Infrastructure\Mink\MinkSessionRequestHelper;
use RuntimeException;

final class ApiContext extends RawMinkContext
{
    private MinkHelper               $sessionHelper;
    private Session                  $minkSession;
    private MinkSessionRequestHelper $request;

    public function __construct(Session $minkSession)
    {
        $this->minkSession   = $minkSession;
        $this->sessionHelper = new MinkHelper($this->minkSession);
        $this->request       = new MinkSessionRequestHelper(new MinkHelper($minkSession));
    }

    /**
     * @Given I send a :method request to :url
     */
    public function iSendARequestTo(string $method, string $url): void
    {
        $this->request->sendRequest($method, $this->locatePath($url));
    }

    /**
     * @Given I send a :method request to :url with body:
     */
    public function iSendARequestToWithBody(string $method, string $url, PyStringNode $body): void
    {
        $this->request->sendRequestWithPyStringNode($method, $this->locatePath($url), $body);
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $expectedResponse): void
    {
        $expected = $this->sanitizeOutput($expectedResponse->getRaw());
        $actual   = $this->sanitizeOutput($this->sessionHelper->getResponse());

        if ($expected !== $actual) {
            throw new RuntimeException(
                sprintf("The output does not match!\n\n-- Expected:\n%s\n\n-- Actual:\n%s\n\n", $expected, $actual)
            );
        }
    }

    /**
     * @Then the response status code should be :expectedResponseCode
     */
    public function theResponseStatusCodeShouldBe(int $expectedResponseCode): void
    {
        if ($this->minkSession->getStatusCode() !== $expectedResponseCode) {
            throw new RuntimeException(
                sprintf(
                    'The status code <%s> does not match the expected <%s>',
                    $this->minkSession->getStatusCode(),
                    $expectedResponseCode
                )
            );
        }
    }

    /**
     * @Then the response should be empty
     */
    public function theResponseShouldBeEmpty(): void
    {
        $actual = trim($this->sessionHelper->getResponse());

        if (!empty($actual)) {
            throw new RuntimeException(
                sprintf("The outputs is not empty, Actual:\n%s", $actual)
            );
        }
    }

    private function sanitizeOutput(string $output): string
    {
        return json_encode(json_decode(trim($output), true));
    }
}
