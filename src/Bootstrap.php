<?php

namespace olcaytaner\Sampling;

class Bootstrap
{
    private array $instanceList;

    /**
     * A constructor of {@link Bootstrap} class which takes a sample an array of instances and a seed number, then creates a bootstrap
     * sample using this seed as random number.
     *
     * @param array $instanceList  Original sample
     * @param int $seed Random number to create boostrap sample
     */
    public function __construct(array $instanceList, int $seed){
        $this->instanceList = [];
        srand($seed);
        $N = count($instanceList);
        for ($i = 0; $i < $N; $i++) {
            $this->instanceList[] = $instanceList[floor((mt_rand() / mt_getrandmax()) * $N)];
        }
    }

    /**
     * getSample returns the produced bootstrap sample.
     *
     * @return array Produced bootstrap sample
     */
    public function getSample(): array{
        return $this->instanceList;
    }
}