<?php

namespace UnzerSDK\test\unit\Resources\PaymentTypes;

use UnzerSDK\Resources\PaymentTypes\Clicktopay;
use UnzerSDK\Resources\PaymentTypes\OpenBanking;
use UnzerSDK\test\BasePaymentTest;
use UnzerSDK\test\Fixtures\JsonProvider;

class OpenBankingTest extends BasePaymentTest
{
    /**
     * Verify the resource data is set properly.
     *
     * @test
     */
    public function constructorShouldSetParameters(): void
    {
        $countryCode = 'DE';

        $openBanking = new OpenBanking($countryCode);


        $this->assertEquals($countryCode, $openBanking->getIbanCountry());
    }

    /**
     * Test  OpenBanking json serialization.
     *
     * @test
     */
    public function jsonSerialization(): void
    {
        $openBankingObject = new OpenBanking("DE",);

        $expectedJson = JsonProvider::getJsonFromFile('openBanking/createRequest.json');
        $this->assertJsonStringEqualsJsonString($expectedJson, $openBankingObject->jsonSerialize());
    }

    /**
     * Test OpenBanking json response handling.
     *
     * @test
     */
    public function openBankingAuthorizationShouldBeMappedCorrectly(): void
    {
        $openBanking = new OpenBanking('DE');

        $jsonResponse = JsonProvider::getJsonFromFile('openBanking/fetchResponse.json');

        $jsonObject = json_decode($jsonResponse, false, 512, JSON_THROW_ON_ERROR);
        $openBanking->handleResponse($jsonObject);

        $this->assertEquals('s-obp-q0nucec6itwe', $openBanking->getId());
    }
}