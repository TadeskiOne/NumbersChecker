<?php

namespace NumbersChecker\Tests;

use PHPUnit\Framework\MockObject\Exception as MockException;
use PHPUnit\Framework\TestCase;
use NumbersChecker\Definitions\CalcEntitiesCollectionInterface;
use NumbersChecker\Definitions\CalcEntityInterface;
use NumbersChecker\Services\Calc;
use NumbersChecker\Services\CalcRules\ModRule;

class NumbersCheckerTest extends TestCase
{
    /**
     * @return void
     * @throws MockException
     */
    public function testCaseMod3and5()
    {
        $expect = [
            1,
            2,
            'pa',
            4,
            'pow',
            'pa',
            7,
            8,
            'pa',
            'pow',
            11,
            'pa',
            13,
            14,
            'papow',
            16,
            17,
            'pa',
            19,
            'pow',
        ];

        $collection = $this->mockCollection(20);
        $service = (new Calc())
            ->setCondition(new ModRule(3, 'pa'))
            ->setCondition(new ModRule(5, 'pow'));

        $result = $service->process($collection);

        foreach ($result as $i => $item) {
            $this->assertEquals($expect[$i], $item);
        }

        echo implode(' ', iterator_to_array($result)), PHP_EOL;
    }

    /**
     * @return void
     * @throws MockException
     */
    public function testCaseMod2and7()
    {
        $expect = [
            1,
            'hatee',
            3,
            'hatee',
            5,
            'hatee',
            'ho',
            'hatee',
            9,
            'hatee',
            11,
            'hatee',
            13,
            'hateeho',
            15,
        ];

        $collection = $this->mockCollection(15);
        $service = (new Calc())
            ->setCondition(new ModRule(2, 'hatee'))
            ->setCondition(new ModRule(7, 'ho'));

        $result = $service->process($collection);
        foreach ($result as $i => $item) {
            $this->assertEquals($expect[$i], $item);
        }

        echo implode('-', iterator_to_array($result)), PHP_EOL;
    }

    /**
     * @param int $count
     *
     * @return CalcEntitiesCollectionInterface
     * @throws MockException
     */
    private function mockCollection(int $count): CalcEntitiesCollectionInterface
    {
        $collection = $this->createMock(CalcEntitiesCollectionInterface::class);
        $iteratorData = new \stdClass();
        $iteratorData->array = [];
        $iteratorData->position = 0;

        for ($i = 1; $i <= $count; $i++) {
            $vo = $this->createMock(CalcEntityInterface::class);
            $vo->expects($this->any())
               ->method('getValue')
               ->willReturn($i);

            $iteratorData->array[] = $vo;
        }

        $collection->expects($this->any())
                   ->method('rewind')
                   ->willReturnCallback(
                       function () use ($iteratorData) {
                           $iteratorData->position = 0;
                       }
                   );

        $collection->expects($this->any())
                   ->method('current')
                   ->willReturnCallback(
                       function () use ($iteratorData) {
                           return $iteratorData->array[$iteratorData->position];
                       }
                   );

        $collection->expects($this->any())
                   ->method('key')
                   ->willReturnCallback(
                       function () use ($iteratorData) {
                           return $iteratorData->position;
                       }
                   );

        $collection->expects($this->any())
                   ->method('next')
                   ->willReturnCallback(
                       function () use ($iteratorData) {
                           $iteratorData->position++;
                       }
                   );

        $collection->expects($this->any())
                   ->method('valid')
                   ->willReturnCallback(
                       function () use ($iteratorData) {
                           return isset($iteratorData->array[$iteratorData->position]);
                       }
                   );

        return $collection;
    }
}