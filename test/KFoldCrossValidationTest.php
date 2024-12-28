<?php

use olcaytaner\Sampling\KFoldCrossValidation;
use PHPUnit\Framework\TestCase;

class KFoldCrossValidationTest extends TestCase
{
    private array $largeSample;

    public function setUp(): void
    {
        $this->largeSample = [];
        for ($i = 0; $i < 1000; $i++) {
            $this->largeSample[] = $i;
        }
    }

    public function testLargeSample10Fold()
    {
        $kFoldCrossValidation = new KFoldCrossValidation($this->largeSample, 10, 1, 0);
        for ($i = 0; $i < 10; $i++) {
            $items = [];
            foreach ($kFoldCrossValidation->getTrainFold($i) as $item) {
                $items[] = $item;
            }
            foreach ($kFoldCrossValidation->getTestFold($i) as $item) {
                $items[] = $item;
            }
            $this->assertEquals(100, count($kFoldCrossValidation->getTestFold($i)));
            $this->assertEquals(900, count($kFoldCrossValidation->getTrainFold($i)));
            $this->assertEquals(1000, count($items));
        }
    }

    public function testLargeSample5Fold()
    {
        $kFoldCrossValidation = new KFoldCrossValidation($this->largeSample, 5, 1, 0);
        for ($i = 0; $i < 5; $i++) {
            $items = [];
            foreach ($kFoldCrossValidation->getTrainFold($i) as $item) {
                $items[] = $item;
            }
            foreach ($kFoldCrossValidation->getTestFold($i) as $item) {
                $items[] = $item;
            }
            $this->assertEquals(200, count($kFoldCrossValidation->getTestFold($i)));
            $this->assertEquals(800, count($kFoldCrossValidation->getTrainFold($i)));
            $this->assertEquals(1000, count($items));
        }
    }

    public function testLargeSample2Fold()
    {
        $kFoldCrossValidation = new KFoldCrossValidation($this->largeSample, 2, 1, 0);
        for ($i = 0; $i < 2; $i++) {
            $items = [];
            foreach ($kFoldCrossValidation->getTrainFold($i) as $item) {
                $items[] = $item;
            }
            foreach ($kFoldCrossValidation->getTestFold($i) as $item) {
                $items[] = $item;
            }
            $this->assertEquals(500, count($kFoldCrossValidation->getTestFold($i)));
            $this->assertEquals(500, count($kFoldCrossValidation->getTrainFold($i)));
            $this->assertEquals(1000, count($items));
        }
    }

}
