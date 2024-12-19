<?php

namespace olcaytaner\Math;

class StratifiedKFoldCrossValidation extends CrossValidation
{

    private array $instanceLists;
    private array $N;

    /**
     * A constructor of {@link StratifiedKFoldCrossValidation} class which takes as set of class samples as an array of array of instances, a K (K in K-fold cross-validation) and a seed number,
     * then shuffles each class sample using the seed number.
     *
     * @param array $instanceLists Original class samples. Each element of the this array is a sample only from one class.
     * @param int $K K in K-fold cross-validation
     * @param int $seed Random number to create K-fold sample(s)
     */
    public function __construct(array $instanceLists, int $K, int $seed)
    {
        $this->instanceLists = $instanceLists;
        $this->N = [];
        srand($seed);
        for ($i = 0; $i < count($instanceLists); $i++) {
            shuffle($this->instanceLists[$i]);
            $this->N[] = count($this->instanceLists[$i]);
        }
        $this->K = $K;
    }

    /**
     * getTrainFold returns the k'th train fold in K-fold stratified cross-validation.
     *
     * @param int $k index for the k'th train fold of the K-fold stratified cross-validation
     * @return array Produced training sample
     */
    function getTrainFold(int $k): array
    {
        $trainFold = [];
        for ($i = 0; $i < count($this->N); $i++) {
            for ($j = 0; $j < ($k * $this->N[$i]) / $this->K; $j++) {
                $trainFold[] = $this->instanceLists[$i][$j];
            }
            for ($j = (($k + 1) * $this->N[$i]) / $this->K; $j < $this->N[$i]; $j++) {
                $trainFold[] = $this->instanceLists[$i][$j];
            }
        }
        return $trainFold;
    }

    /**
     * getTestFold returns the k'th test fold in K-fold stratified cross-validation.
     *
     * @param int $k index for the k'th test fold of the K-fold stratified cross-validation
     * @return array Produced testing sample
     */
    function getTestFold(int $k): array
    {
        $testFold = [];
        for ($i = 0; $i < count($this->N); $i++) {
            for ($j = ($k * $this->N[$i]) / $this->K; $j < (($k + 1) * $this->N[$i]) / $this->K; $j++) {
                $testFold[] = $this->instanceLists[$i][$j];
            }
        }
        return $testFold;
    }
}