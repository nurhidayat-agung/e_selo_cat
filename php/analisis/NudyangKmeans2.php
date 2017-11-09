<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 10/2/2017
 * Time: 7:02 AM
 */
class NudyangKmeans2
{
    private $b = array();
    private $idBankSoal;
    private $nCluster;
    private $cens = array();
    private $oldArray = array();
    private $newArray = array();
    private $countLoop = 1;
    private $postArray = array();
    private $bDasar = array();


    /**
     * NudyangKmeans constructor.
     * @param array $b
     * @param $idBankSoal
     * @param $nCluster
     */
    public function __construct(array $b, $idBankSoal, $nCluster)
    {
        $this->idBankSoal = $idBankSoal;
        $this->nCluster = $nCluster;
        $this->b = array_values(array_map("unserialize",
            array_unique(array_map("serialize", $b))));
        $this->bDasar = $b;
    }

    public function getCentroid(){
        $this->setFirstCentroid();
        $this->initCluster();
        while (!$this->arrayDeepEqual($this->oldArray,$this->newArray)
            && $this->countLoop < 2500){
            $this->countLoop ++;
            $this->initCluster();
        }
        $this->bubbleSort();
        foreach ($this->newArray as $item => $value){
            $this->postArray[] = $value;
        }
        $postData = array(
            'status' => true,
            'perulangan' => $this->countLoop,
            'centroid' => $this->cens,
            'baru' => $this->postArray,
            'lama' => $this->oldArray,
            'input' => $this->bDasar
        );
        return $postData;
    }

    public function isCluster(){
        if (count($this->b) < $this->nCluster){
            return false;
        }else{
            return true;
        }
    }



    public function setFirstCentroid(){
        for ($a = 0; $a < $this->nCluster; $a++){
            $this->cens[$a] = $this->b[$a];
        }
    }

    public function initCluster(){
        unset($this->oldArray);
        unset($this->newArray);
        $this->oldArray = array();
        $this->newArray = array();
        foreach ($this->b as $sulit => $sulits){
            $this->oldArray[$this->getClose($this->cens,$sulits)][] = $sulits;
        }
        foreach ($this->oldArray as $vektor => $datas){
            $diff = 0;
            $disc = 0;
            foreach ($datas as $in => $inData){
                $diff += $inData[0];
                $disc += $inData[1];
            }
            $diffs = $diff/count($datas);
            $discs = $disc/count($datas);
            $this->cens[$vektor] = [$diffs,$discs];
        }
        array_multisort($this->cens);
        $this->cens = array_reverse($this->cens);
        foreach ($this->b as $sulit){
            $this->newArray[$this->getClose($this->cens,$sulit)][] = $sulit;
        }
    }

    public function bubbleSort(){
        for ($lit1 = 0; $lit1 < count($this->newArray); $lit1++){
            for ($lit2 = 1; $lit2 < count($this->newArray)-$lit1; $lit2++){
                if ($this->avgDeep($this->newArray[$lit2-1])
                    < $this->avgDeep($this->newArray[$lit2])){
                    $temp = $this->newArray[$lit2-1];
                    $this->newArray[$lit2-1]=$this->newArray[$lit2];
                    $this->newArray[$lit2] = $temp;
                }
            }
        }
    }

    public function avgDeep($rawArr){
        $sumRaw = 0;
        foreach ($rawArr as $valueRaw){
            foreach ($valueRaw as $itemRaw2 => $valueRaw2){
                if ($itemRaw2 == 0){
                    $sumRaw += $valueRaw2;
                }
            }
        }
        return $sumRaw/count($rawArr);
    }

    public function getClose($cens,$member){
        $a = abs($member[0] - $cens[0][0]) + (abs($member[1] - $cens[0][1])/2);
        $b = 0;
        foreach ($cens as $cen => $fiz){
            $d = abs($member[0] - $fiz[0]) + (abs($member[1] - $fiz[1])/2);
            if ($a > $d){
                $a = $d;
                $b = $cen;
            }
        }
        return $b;
    }

    public function arrayDeepEqual($arr1, $arr2){
        if (count($arr1) != count($arr2)){
            return false;
        }else{
            foreach ($arr1 as $key => $item){
                if (count($arr1[$key]) != count($arr2[$key]) || !$this->isSumDeep($arr1[$key],$arr2[$key])){
                    return false;
//                    print_r($arr1);
//                    echo '<br />';
//                    print_r($arr2);
                }else{
                    $sumOldSulit = $this->putSingle($arr1[$key],0);
                    $sumNewSulit = $this->putSingle($arr2[$key],0);
                    $sumOldBeda = $this->putSingle($arr1[$key],1);
                    $sumNewBeda = $this->putSingle($arr2[$key],1);
                    if ($sumOldBeda !== $sumNewBeda || $sumOldSulit !== $sumNewSulit){
                        return false;
                    }
                }
            }
            return true;
        }
    }

    public function isSumDeep($arr3, $arr4){
        $in1 = 0;
        $in2 = 0;
        $in3 = 0;
        $in4 = 0;
        foreach ($arr3 as $item2 => $value2){
            $in1 += $value2[0];
            $in2 += $value2[1];
        }
        foreach ($arr4 as $item3 => $value3){
            $in3 += $value3[0];
            $in4 += $value3[1];
        }
        if ($in1 == $in3 && $in2 == $in4){
            return true;
        }else{
            return false;
        }
    }

    public function putSingle($arr5,$in5){
        $singleArray = array();
        foreach ($arr5 as $item4 => $value4){
            $singleArray[] = $value4[$in5];
        }
        return $singleArray;
    }
}