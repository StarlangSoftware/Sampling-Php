<?php

namespace olcaytaner\Math;

use PHPUnit\Framework\TestCase;

class StratifiedKFoldCrossValidationTest extends TestCase
{
    private array $largeSample;

    public function setUp(): void
    {
        $class1 = [];
        for ($i = 0; $i < 1000; $i++) {
            $class1[] = $i;
        }
        $class2 = [];
        for ($i = 0; $i < 3000; $i++) {
            $class2[] = 1000 + $i;
        }
        $class3 = [];
        for ($i = 0; $i < 5000; $i++) {
            $class3[] = 4000 + $i;
        }
        $this->largeSample = [];
        $this->largeSample[] = $class1;
        $this->largeSample[] = $class2;
        $this->largeSample[] = $class3;
    }

    public function testlargeSample5Fold()
    {
        $stratifiedKFoldCrossValidation = new StratifiedKFoldCrossValidation($this->largeSample, 5, 1);
        for ($i = 0; $i < 5; $i++) {
            $items = [];
            foreach ($stratifiedKFoldCrossValidation->getTrainFold($i) as $item) {
                $items[] = $item;
            }
            foreach ($stratifiedKFoldCrossValidation->getTestFold($i) as $item) {
                $items[] = $item;
            }
            $this->assertCount(1800, $stratifiedKFoldCrossValidation->getTestFold($i));
            $this->assertCount(7200, $stratifiedKFoldCrossValidation->getTrainFold($i));
            $this->assertCount(9000, $items);
            $trainCounts = [0, 0, 0];
            foreach ($stratifiedKFoldCrossValidation->getTrainFold($i) as $integer) {
                if ($integer < 1000) {
                    $trainCounts[0]++;
                } else {
                    if ($integer < 4000) {
                        $trainCounts[1]++;
                    } else {
                        $trainCounts[2]++;
                    }
                }
            }
            $this->assertEquals(800, $trainCounts[0]);
            $this->assertEquals(2400, $trainCounts[1]);
            $this->assertEquals(4000, $trainCounts[2]);
            $testCounts = [0, 0, 0];
            foreach ($stratifiedKFoldCrossValidation->getTestFold($i) as $integer) {
                if ($integer < 1000) {
                    $testCounts[0]++;
                } else {
                    if ($integer < 4000) {
                        $testCounts[1]++;
                    } else {
                        $testCounts[2]++;
                    }
                }
            }
            $this->assertEquals(200, $testCounts[0]);
            $this->assertEquals(600, $testCounts[1]);
            $this->assertEquals(1000, $testCounts[2]);
        }
    }

    public function testlargeSample10Fold()
    {
        $stratifiedKFoldCrossValidation = new StratifiedKFoldCrossValidation($this->largeSample, 10, 1);
        for ($i = 0; $i < 10; $i++) {
            $items = [];
            foreach ($stratifiedKFoldCrossValidation->getTrainFold($i) as $item) {
                $items[] = $item;
            }
            foreach ($stratifiedKFoldCrossValidation->getTestFold($i) as $item) {
                $items[] = $item;
            }
            $this->assertCount(900, $stratifiedKFoldCrossValidation->getTestFold($i));
            $this->assertCount(8100, $stratifiedKFoldCrossValidation->getTrainFold($i));
            $this->assertCount(9000, $items);
            $trainCounts = [0, 0, 0];
            foreach ($stratifiedKFoldCrossValidation->getTrainFold($i) as $integer) {
                if ($integer < 1000) {
                    $trainCounts[0]++;
                } else {
                    if ($integer < 4000) {
                        $trainCounts[1]++;
                    } else {
                        $trainCounts[2]++;
                    }
                }
            }
            $this->assertEquals(900, $trainCounts[0]);
            $this->assertEquals(2700, $trainCounts[1]);
            $this->assertEquals(4500, $trainCounts[2]);
            $testCounts = [0, 0, 0];
            foreach ($stratifiedKFoldCrossValidation->getTestFold($i) as $integer) {
                if ($integer < 1000) {
                    $testCounts[0]++;
                } else {
                    if ($integer < 4000) {
                        $testCounts[1]++;
                    } else {
                        $testCounts[2]++;
                    }
                }
            }
            $this->assertEquals(100, $testCounts[0]);
            $this->assertEquals(300, $testCounts[1]);
            $this->assertEquals(500, $testCounts[2]);
        }
    }

    public function testlargeSample2Fold()
    {
        $stratifiedKFoldCrossValidation = new StratifiedKFoldCrossValidation($this->largeSample, 2, 1);
        for ($i = 0; $i < 2; $i++) {
            $items = [];
            foreach ($stratifiedKFoldCrossValidation->getTrainFold($i) as $item) {
                $items[] = $item;
            }
            foreach ($stratifiedKFoldCrossValidation->getTestFold($i) as $item) {
                $items[] = $item;
            }
            $this->assertCount(4500, $stratifiedKFoldCrossValidation->getTestFold($i));
            $this->assertCount(4500, $stratifiedKFoldCrossValidation->getTrainFold($i));
            $this->assertCount(9000, $items);
            $trainCounts = [0, 0, 0];
            foreach ($stratifiedKFoldCrossValidation->getTrainFold($i) as $integer) {
                if ($integer < 1000) {
                    $trainCounts[0]++;
                } else {
                    if ($integer < 4000) {
                        $trainCounts[1]++;
                    } else {
                        $trainCounts[2]++;
                    }
                }
            }
            $this->assertEquals(500, $trainCounts[0]);
            $this->assertEquals(1500, $trainCounts[1]);
            $this->assertEquals(2500, $trainCounts[2]);
            $testCounts = [0, 0, 0];
            foreach ($stratifiedKFoldCrossValidation->getTestFold($i) as $integer) {
                if ($integer < 1000) {
                    $testCounts[0]++;
                } else {
                    if ($integer < 4000) {
                        $testCounts[1]++;
                    } else {
                        $testCounts[2]++;
                    }
                }
            }
            $this->assertEquals(500, $testCounts[0]);
            $this->assertEquals(1500, $testCounts[1]);
            $this->assertEquals(2500, $testCounts[2]);
        }
    }

}
