<?php
/**
 * This class defines unit tests to verify functionality of the resource name service.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * @license http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * @copyright Copyright © 2016-present heidelpay GmbH. All rights reserved.
 *
 * @link  http://dev.heidelpay.com/
 *
 * @author  Simon Gabriel <development@heidelpay.com>
 *
 * @package  heidelpay/mgw_sdk/tests/integration
 */
namespace heidelpay\MgwPhpSdk\test\unit;

use heidelpay\MgwPhpSdk\Services\ResourceNameService;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

class ResourceNameServiceTest extends TestCase
{
    /**
     * Verify getting the short name of a class.
     *
     * @test
     * @dataProvider classShortNameTestDP
     * @param string $className
     * @param string $expected
     * @throws Exception
     * @throws ExpectationFailedException
     */
    public function shouldReturnTheCorrectShortName($className, $expected)
    {
        $this->assertEquals($expected, ResourceNameService::getClassShortNameKebapCase($className));
    }

    /**
     * @return array
     */
    public function classShortNameTestDP(): array
    {
        return [
            'normal class name' => ['className' => 'Path\\To\\Test\\Class', 'expected' => 'class'],
            'camel case class' => ['className' => 'Path\\To\\Test\\CamelCaseClass', 'expected' => 'camel-case-class'],
            'upper case class' => ['className' => 'Path\\To\\Test\\CCC', 'expected' => 'ccc']
        ];
    }
}
