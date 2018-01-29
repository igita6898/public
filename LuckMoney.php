<?php
/**
 * 红包算法
 * Created by Igita Huang.
 * Author: Igita Huang <igita@qq.com>
 * Date: 2018/1/25 16:17
 */

class LuckMoney{


    /**
     * Luck Money
     * @var float
     */
    static $money               = 0.0;

    /**
     * Luck Money quantity
     * @var int
     */
    static $quantity            = 1;

    /**
     * Luck Money
     * @var float
     */
    static $minMoney               = 0.01;

    /**
     * Average Luck Money
     * @var float
     */
    static $avg                    = 0.0;

    /**
     * left Quantity
     * @var int
     */
    static $leftQuantity                    = 1;

    /**
     * left Luck Money
     * @var float
     */
    static $leftMoney                    = 0.0;

    /**
     * Result of Luck Money
     * @var int| array
     */
    public $result             = null;

    public function __construct($money,$quantity)
    {
        self::$money            = $money;
        self::$leftMoney        = $money;
        if(intval($quantity)>=1){
            self::$quantity         = $quantity;
            self::$leftQuantity     = $quantity;
        }


    }

    /**
     *
     * @param int $type
     * Author: Igita Huang <igita@qq.com>
     * Date: 2018/1/25 16:30
     */
    public function generateMoney($type=1)
    {
        if($type === 1){
            return $this->getLuckMoneyPlanA();
        }else if ($type === 2){
            return $this->getLuckMoneyPlanB();
        }

        return $this->getLuckMoneyPlanB();
    }

    /**
     *
     * @return array
     * Author: Igita Huang <igita@qq.com>
     * Date: 2018/1/25 16:30
     */
    public function getLuckMoneyPlanA()
    {
        $result = [];

        if(self::$quantity>1){
            array_push($result,$this->getMaxLuckMoney());
            if(self::$money <= 1){
                array_push($result,$this->getMinLuckMoney());
                self::$leftMoney -= $this->getMinLuckMoney();
                self::$leftQuantity -= 1;

                for($i=0;$i<self::$quantity-2;$i++){
                    $left_avg = self::$leftMoney/(self::$quantity);
                    if($i==self::$quantity-3){
                        $temp = self::$leftMoney;
                    }else{
                        $temp = number_format($left_avg , 2);
                    }
                    self::$leftMoney -= $temp;
                    self::$leftQuantity -= 1;
                    array_push($result,$temp);

                }
            }else{
                for($i=0;$i<self::$quantity-1;$i++){
                    $left_avg = self::$leftMoney/(self::$quantity);
                    if($i==self::$quantity-2){
                        $temp = self::$leftMoney;
                    }else{
/*                        $operate = self::randomOperation();
                        if($operate === '+'){
                            $temp = number_format($left_avg - $this->randomFloat(), 2);
                        }else if($operate === '-'){
                            $temp = number_format($left_avg - $this->randomFloat(), 2);
                        }*/

                        $temp =number_format($left_avg, 2); ;
                    }
                    self::$leftMoney -= $temp;
                    self::$leftQuantity -= 1;
                    array_push($result,$temp);

                }
            }
        }else{
            array_push($result,self::$money);
            self::$leftMoney -= self::$money;
            self::$leftQuantity -= 1;
        }


        shuffle($result);
        return $result;
    }

    public function getLuckMoneyPlanB()
    {

    }

    public function getMaxLuckMoney()
    {
        $operate = self::randomOperation();
        if($operate === '+'){
            $max_luck = (float) ($this->getAvg(self::$money, self::$quantity) * 2 ) + $this->randomFloat();
        }else if($operate === '-'){
            $max_luck = (float) ($this->getAvg(self::$money,self::$quantity) * 2 ) - $this->randomFloat();
        }

        self::$leftQuantity -= 1;
        self::$leftMoney -= $max_luck;
        return $max_luck;
    }

    public function randomFloat()
    {
        if(self::$leftMoney > 1){
            $random = number_format(rand(0,49)/100,2);
        }else if(self::$leftMoney <= 1 && self::$leftMoney >0.5) {
            $random = number_format(rand(0,25)/100,2);
        }else{
            $random = number_format(rand(0,9)/100,2);
        }
        return (float) $random;
    }

    public function getAvg($money,$quantity)
    {
        return (float) number_format($money/$quantity,2);
    }

    public function getMinLuckMoney()
    {
        return self::$minMoney;
    }

    public static function randomOperation(){
        $operation = array('+','-');
        return $operation[rand(0,1)];
    }
}

