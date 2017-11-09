<?php
/**
 * Created by PhpStorm.
 * User: kazt
 * Date: 10/2/2017
 * Time: 7:02 AM
 */
class NudyangKmeans
{
    private $b = array();
    private $idBankSoal;
    private $nCluster;
    private $cens = array();
    private $oldArray = array();
    private $newArray = array();
    private $countLoop = 0;

    /**
     * NudyangKmeans constructor.
     * @param array $b
     * @param $idBankSoal
     * @param $nCluster
     */
    public function __construct(array $b, $idBankSoal, $nCluster)
    {
        $this->b = $b;
        $this->idBankSoal = $idBankSoal;
        $this->nCluster = $nCluster;
        rsort($this->b);
    }

    public function getCentroid(){
        $this->setFirstCentroid();
        $this->initCluster();
        $this->initCluster();

        while (!$this->arrayDeepEqual($this->oldArray,$this->newArray)){
            $this->countLoop ++;
            $this->initCluster();
        }
        $postData = array(
            'status' => true,
            'perulangan' => $this->countLoop,
            'centroid' => $this->cens,
            'cluster' => $this->newArray
        );

        return $postData;
    }

    public function isCluster(){
        if (count(array_unique($this->b)) < $this->nCluster){
            return false;
        }else{
            return true;
        }
    }

    public function setFirstCentroid(){
        $tempC = array();
        foreach (array_unique($this->b) as $key => $value){
            $tempC[] = $value;
        }
        for ($a = 0; $a < $this->nCluster; $a++){
            $this->cens[$a] = $tempC[$a];
        }
    }

    public function initCluster(){
        unset($this->oldArray);
        unset($this->newArray);
        $this->oldArray = array();
        $this->newArray = array();
        foreach ($this->b as $sulit){
            $this->oldArray[$this->getClose($this->cens,$sulit)][] = $sulit;
        }
        foreach ($this->oldArray as $vektor => $datas){
            $a = array_sum($datas)/count($datas);
            $this->cens[$vektor] = $a;
        }
        foreach ($this->b as $sulit){
            $this->newArray[$this->getClose($this->cens,$sulit)][] = $sulit;
        }
    }

    public function getClose($cens,$member){
        $a = abs($member - $cens[0]);
        $b = 0;
        foreach ($cens as $cen => $data){
            if ($a > abs($data-$member)){
                $a = abs($member - $data);
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
                if (count($arr1[$key]) != count($arr2[$key]) || array_sum($arr1[$key]) != array_sum($arr2[$key])){
                    return false;
                }else{
                    rsort($arr1[$key]);
                    rsort($arr2[$key]);
                    foreach ($item as $keyValue => $value){
                        if ($arr1[$key][$keyValue] != $arr2[$key][$keyValue]){
                            return false;
                        }
                    }
                }
            }
            return true;
        }
    }
}