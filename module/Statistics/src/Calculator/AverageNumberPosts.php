<?php

namespace Statistics\Calculator;

use SocialPost\Dto\SocialPostTo;
use Statistics\Dto\StatisticsTo;

/**
 * Class AveragePosts
 *
 * @package Statistics\Calculator
 */
class AverageNumberPosts extends AbstractCalculator
{

    protected const UNITS = 'posts';

    /**
     * @var array
     */
    private $totals = [];

     /**
     * @var int
     */
    private $postCount = 0;

    /**
     * @var int
     */
    private $userCount = 0;

     /**
     * @var array
     */
    private $userArray = [];

    /**
     * Set user count
     */
    public function setUserCount($value) {
        $this->userCount = intval($value);
      }
  
    /**
     * Set post count
    */
    public function setPostCount($value) {
        $this->postCount = intval($value);
    }

    /**
     * Set post count
    */
    public function getCalculate() {
        echo $this->userCount;
        return $this->doCalculate();
    }
  
    /**
     * @param SocialPostTo $postTo
     */
    protected function doAccumulate(SocialPostTo $postTo): void
    {
        $user = $postTo->getAuthorId(); 
         if (!in_array($user, $this->userArray)) {
            array_push($this->userArray, $user);
            $this->userCount++;
        }
        $this->postCount++;
    }
    /**
     * @return StatisticsTo
     */
    protected function doCalculate(): StatisticsTo
    {
        $value = ($this->userCount > 0 ? $this->postCount/$this->userCount : 0);
        return (new StatisticsTo())->setValue(round($value,2));
    }
}
