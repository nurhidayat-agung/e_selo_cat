 <?php  
  //insert.php
    include "../connection.php";
    $data = json_decode(file_get_contents("php://input"));
    $cekB = 1;
    $icekB = 0;
    $cekA = 1;
    $icekA = 0;
    $cekC = 1;
    $icekC = 0;

    if(count($data) > 0)
    {
        $idMapel = mysqli_real_escape_string($conn, $data->idMapel);
        $idBanksoal = mysqli_real_escape_string($conn, $data->idBanksoal);
        $query = "select DISTINCT idSoal from detailrespon as d inner join responTest as r on d.idResponTest = r.idResponTest where idBankSoal = ".$idBanksoal." and status = 'finish'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result))
        {
            $idSoal[] = $row['idSoal'];
        }
        $b = array();
        $a = array();
        $jawabBetul = array();
        $count = count($idSoal);
        for($i = 0; $i < $count; $i++){
            $cmd = "select count(idSoal) from detailrespon as d inner join responTest as r on d.idResponTest = r.idResponTest where idSoal = ".$idSoal[$i]." and croscek = 1 and idBanksoal = ".$idBanksoal." and status = 'finish' and jenis = 'klasik'";
            $countRes = mysqli_query($conn, $cmd);
            $temp = mysqli_fetch_row($countRes);
            $jawabBetul[$i] = $temp[0];
            $cmd2 = "select count(idSoal) from detailrespon as d inner join responTest as r on d.idResponTest = r.idResponTest where idSoal = ".$idSoal[$i]." and idBanksoal = ".$idBanksoal." and status = 'finish' and jenis = 'klasik'";
            $countRes2 = mysqli_query($conn, $cmd2);
            $temp2 = mysqli_fetch_row($countRes2);
            $total = $temp2[0];
            $b[$i] = $jawabBetul[$i]/$total;
            $cmdPushB = "update soalDetail set tingkatKesulitanSoal = $b[$i] where idSoal = $idSoal[$i]";
            if(mysqli_query($conn,$cmdPushB)){
                $cekB = 1;
            }else{
                $icekB = 1;
            }
        }

        // daya beda
        $cmdGetRange = floor($count/2);
        // echo $cmdGetRange;
        // echo '<br />';
        for($x = 0; $x < $count; $x++){
            $cmdBA = "SELECT COUNT( * ) FROM detailrespon AS d INNER JOIN (SELECT * FROM responTest WHERE STATUS = 'finish' AND jenis =  'klasik' and idBankSoal = ".$idBanksoal." ORDER BY nilaiResponTest desc LIMIT ".$cmdGetRange.") AS r ON d.idResponTest = r.idResponTest WHERE idSoal = ".$idSoal[$x]." AND croscek = 1";
            $queryBA = mysqli_query($conn,$cmdBA);
            $tempBA = mysqli_fetch_row($queryBA);
            $ba = $tempBA[0];

            $cmdBB = "SELECT COUNT( * ) FROM detailrespon AS d INNER JOIN (SELECT * FROM responTest WHERE STATUS = 'finish' AND jenis =  'klasik' and idBankSoal = ".$idBanksoal." ORDER BY nilaiResponTest asc LIMIT ".$cmdGetRange.") AS r ON d.idResponTest = r.idResponTest WHERE idSoal = ".$idSoal[$x]." AND croscek = 1";
            $queryBB = mysqli_query($conn, $cmdBB);
            $tempBB = mysqli_fetch_row($queryBB);
            $bb = $tempBB[0];
            $tempa = (2 * ($ba - $bb));
            $a[$x] = $tempa / $count;
            $cmdPushB = "update soalDetail set dayaBeda = $a[$x] where idSoal = $idSoal[$x]";
            if(mysqli_query($conn,$cmdPushB)){
                $cekA = 1;
            }else{
                $icekA = 1;
            }
            // echo "bb $x = $bb";
            // echo '<br />';
            // echo "ba $x = $ba";
            // echo '<br />';
            // echo "daya beda $x = $a[$x]";
            // echo '<br />';
        }

        //clustering
        $idSoalCluster = array();
        $tingkatKesulitan = array();
        $dayaBeda = array();
        $cmdClustering = "select idSoal,dayaBeda,tingkatKesulitanSoal from soalDetail where idBankSoal = $idBanksoal";
        $rClustering = mysqli_query($conn,$cmdClustering);
        while($rowCluster = mysqli_fetch_array($rClustering)){
            $dayaBeda[] = $rowCluster['dayaBeda'];
            $tingkatKesulitan[] = $rowCluster['tingkatKesulitanSoal'];
            $idSoalCluster[] = $rowCluster['idSoal'];
        }

        $cluster1[] = array(array());
        $cluster1 = kmeans($tingkatKesulitan, 4);
        // print_r($cluster1[0]);
        // echo '<br />';
        // print_r($cluster1[1]);
        // echo '<br />';
        // print_r($cluster1[2]);
        // echo '<br />';
        // print_r($cluster1[3]);
        // echo '<br />';
        $count1 = count($cluster1[0]);
        $count2 = count($cluster1[1]);
        $count3 = count($cluster1[2]);
        $count4 = count($cluster1[3]);
        $c1a = array_sum($cluster1[0])/$count1;
        $c2a = array_sum($cluster1[1])/$count2;
        $c3a = array_sum($cluster1[2])/$count3;
        $c4a = array_sum($cluster1[3])/$count4;
        $tempCluster = array();
        $tempClustersort = array();
        $tempCluster[0] = $c1a;
        $tempCluster[1] = $c2a;
        $tempCluster[2] = $c3a;
        $tempCluster[3] = $c4a;
        sort($tempCluster);
        $c1 = $tempCluster[0];
        $c2 = $tempCluster[1];
        $c3 = $tempCluster[2];
        $c4 = $tempCluster[3];

        // echo '<br />';
        // print_r($c1);
        // echo '<br />';
        // print_r($c2);
        // echo '<br />';
        // print_r($c3);
        // echo '<br />';
        // print_r($c4);
        // echo '<br />';
        for($l = 0; $l < $count; $l++){
            $dc1 = abs($tingkatKesulitan[$l] - $c1);
            $dc2 = abs($tingkatKesulitan[$l] - $c2);
            $dc3 = abs($tingkatKesulitan[$l] - $c3);
            $dc4 = abs($tingkatKesulitan[$l] - $c4);
            if($dc1 < $dc2 && $dc1 < $dc3 && $dc1 < $dc4){
                //echo "idSoal$l cluster 1"."<br />";
                $cCluster = "update soalDetail set cluster = 1 where idSoal = ".$idSoalCluster[$l];
            }
            if($dc2 < $dc1 && $dc2 < $dc3 && $dc2 < $dc4){
                //echo "idSoal$l cluster 2"."<br />";
                $cCluster = "update soalDetail set cluster = 2 where idSoal = ".$idSoalCluster[$l];
            }
            if($dc3 < $dc1 && $dc3 < $dc2 && $dc3 < $dc4){
                //echo "idSoal$l cluster 3"."<br />";
                $cCluster = "update soalDetail set cluster = 3 where idSoal = ".$idSoalCluster[$l];
            }
            if($dc4 < $dc1 && $dc4 < $dc2 && $dc4 < $dc3){
                //echo "idSoal$l cluster 4"."<br />";
                $cCluster = "update soalDetail set cluster = 4 where idSoal = ".$idSoalCluster[$l];
            }
            if(mysqli_query($conn,$cCluster)){
                $cekC = 1;
            }else{
                $icekC = 1;
            }
        }
        $arrOutput = array();
        $arrOutput += array('a' => $icekA);
        $arrOutput += array('b' => $icekB);
        $arrOutput += array('c' => $icekC);
        echo json_encode($arrOutput);
    }else{
        $arrOutput = array();
        $arrOutput += array('a' => $icekA);
        $arrOutput += array('b' => $icekB);
        $arrOutput += array('c' => $icekC);
        echo json_encode($arrOutput);
    }


    // function clustering
    function kmeans($data, $k)
    {
        $cPositions = assign_initial_positions($data, $k);
        $clusters = array();
        while(true)
        {
            $changes = kmeans_clustering($data, $cPositions, $clusters);
            if(!$changes)
            {
              return kmeans_get_cluster_values($clusters, $data);
            }
            $cPositions = kmeans_recalculate_cpositions($cPositions, $data, $clusters);
        }
    }

    function kmeans_clustering($data, $cPositions, &$clusters)
    {
        $nChanges = 0;
        foreach($data as $dataKey => $value)
        {
            $minDistance = null;
            $cluster = null;
            foreach($cPositions as $k => $position)
            {
                $distance = distance($value, $position);
                if(is_null($minDistance) || $minDistance > $distance)
                {
                      $minDistance = $distance;
                      $cluster = $k;
                }
            }
            if(!isset($clusters[$dataKey]) || $clusters[$dataKey] != $cluster)
            {
                $nChanges++;
            }
            $clusters[$dataKey] = $cluster;
        }

        return $nChanges;
    }

    function kmeans_recalculate_cpositions($cPositions, $data, $clusters)
    {
        $kValues = kmeans_get_cluster_values($clusters, $data);
        foreach($cPositions as $k => $position)
        {
            $cPositions[$k] = empty($kValues[$k]) ? 0 : kmeans_avg($kValues[$k]);
        }
            return $cPositions;
    }

    function kmeans_get_cluster_values($clusters, $data)
    {
        $values = array();
        foreach($clusters as $dataKey => $cluster)
        {
            $values[$cluster][] = $data[$dataKey];
        }
        return $values;
    }


    function kmeans_avg($values)
    {
        $n = count($values);
        $sum = array_sum($values);
        return ($n == 0) ? 0 : $sum / $n;
    }


    function distance($v1, $v2)
    {
        return abs($v1-$v2);
    }


    function assign_initial_positions($data, $k)
    {
        $min = min($data);
        $max = max($data);
        $int = ceil(abs($max - $min) / $k);
        while($k-- > 0)
        {
            $cPositions[$k] = $min + $int * $k;
        }
        return $cPositions;
    }
 ?>