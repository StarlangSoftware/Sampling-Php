<?php

namespace olcaytaner\Math;

abstract class CrossValidation
{
    protected int $K;

    abstract function getTrainFold(int $k): array;
    abstract function getTestFold(int $k): array;
}