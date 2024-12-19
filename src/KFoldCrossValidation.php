<?php

namespace olcaytaner\Math;

class KFoldCrossValidation extends CrossValidation
{

    private array $instanceList;
    private int $N;

    /**
     * A constructor of {@link KFoldCrossValidation} class which takes a sample as an array of instances, a K (K in K-fold cross-validation) and a seed number,
     * then shuffles the original sample using this seed as random number.
     *
     * @param array $instanceList Original sample
     * @param int $K K in K-fold cross-validation
     * @param int $seed Random number to create K-fold sample(s)
     */
    public function __construct(array $instanceList, int $K, int $seed){
        $this->instanceList = $instanceList;
        srand($seed);
        shuffle($this->instanceList);
        $this->N = count($instanceList);
        $this->K = $K;
    }

    /**
     * getTrainFold returns the k'th train fold in K-fold cross-validation.
     *
     * @param int $k index for the k'th train fold of the K-fold cross-validation
     * @return array Produced training sample
     */
    function getTrainFold(int $k): array
    {
        $trainFold = [];
        for ($i = 0; $i < ($k * $this->N) / $this->K; $i++){
            $trainFold[] = $this->instanceList[$i];
        }
        for ($i = (($k + 1) * $this->N) / $this->K; $i < $this->N; $i++){
            $trainFold[] = $this->instanceList[$i];
        }
        return $trainFold;
    }

    /**
     * getTestFold returns the k'th test fold in K-fold cross-validation.
     *
     * @param int $k index for the k'th test fold of the K-fold cross-validation
     * @return array Produced testing sample
     */
    function getTestFold(int $k): array
    {
        $testFold = [];
        for ($i = ($k * $this->N) / $this->K; $i < (($k + 1) * $this->N) / $this->K; $i++){
            $testFold[] = $this->instanceList[$i];
        }
        return $testFold;
    }
}