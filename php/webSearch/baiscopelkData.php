<?php
//Link to download file...

//pages 397

class baiscopelk{
     
    public function Data($url)
    {
        # code...
        // web page viwe
        $data = file_get_contents($url);
        // create new DOMDocument
        $doc = new \DOMDocument('1.0', 'UTF-8');
        // set error level
        $internalErrors = libxml_use_internal_errors(true);
        // load HTML
        $doc->loadHTML($data);
        // Select Element By ID 

        // Select Element By Tag Name
        $select_H_tag=$doc->getElementsByTagName('p');
        // print_r($select_H_tag);
        $uploadDate=$doc->getElementsByTagName('h2');
        $movieData_1 = array();
        foreach ($uploadDate as $h2 ){
            $AttrValue = $h2->getAttribute('class');
            if ($AttrValue=="post-box-title") {
                $Data = $h2->nodeValue;
                $spiltData=explode('|',$Data);
                // print_r($spiltData);
                // $spilt = explode(')',$spiltData[1]));
                // $spilt_1 = $spilt[1].')';
                $spiltDate = explode(']',$spiltData[1]);
                // print_r($spiltDate);
                $arrCount=count($spiltDate);
                if ($arrCount>2) {
                    $date=$spiltDate[2];
                }
                else {
                    $date=$spiltDate[1];
                }
                $spiltData[0]=str_replace("Sinhala Subtitles","",$spiltData[0]);
                $spiltData[0]=str_replace("Sinhala subtitles","",$spiltData[0]);
                

                array_push($movieData_1,$spiltData[0]);
            }
        }
        // print_r($movieData_1);

        foreach($movieData_1 as $nameData_1){
            $nameData_1=str_replace("Sinhala Subtitle","",$nameData_1);
            // echo $nameData_1.'<br>';
        }
            
        $dateArr=array();
        $Date=date("Y/m/d");
        foreach ($select_H_tag as $p ){
            $AttrValue = $p->getAttribute('class');
            if ($AttrValue=="post-meta") {
                $Data = $p->nodeValue;
                // echo $Data.'<br>';
                $x=explode(",",$Data,'3');
                // echo $x[0];
                $x1 = str_replace('18+','',$x[0]);
                $x1.=$x[1];
                $Date_1=str_replace("All","",$x1);
                $Date_2 = str_replace('Featured Articles','',$Date_1);
                // echo $DateName_1;
                
            
              
                array_push($dateArr,$Date_2);
            }
        
        }
        // print_r($dateArr);
        $arrCount=count($dateArr);
        for ($i=0; $i < $arrCount; $i++) { 
            $movieName_Date=$dateArr[$i].'&'.$movieData_1[$i].'<br>';
            $movieName_Date=str_replace('Sinhala Subtitle',"",$movieName_Date);
            $values[] = $movieName_Date;
        }
        return $values;

        libxml_use_internal_errors($internalErrors);

    }

    }
$url='https://www.baiscopelk.com/category/%E0%B7%83%E0%B7%92%E0%B6%82%E0%B7%84%E0%B6%BD-%E0%B6%8B%E0%B6%B4%E0%B7%83%E0%B7%92%E0%B6%BB%E0%B7%90%E0%B7%83%E0%B7%92/%E0%B6%A0%E0%B7%92%E0%B6%AD%E0%B7%8A%E2%80%8D%E0%B6%BB%E0%B6%B4%E0%B6%A7%E0%B7%92/';
$movie = new baiscopelk();
$name = $movie->Data($url);
foreach($name as $movieName){
    // echo $movieName;()

    $date = explode('&',$movieName);
    $date2 = explode(' ',$date[0]);
    
    // echo $date[0]."<br>";
    // for ($h=1; $h <=24 ; $h++) { 
    //     $hour = $h." "."hours ago";
        if("days" == $date2[1]){
            $today=date("Y/m/d");
            $date3 = explode('/',$today);
            $date3[2] -= (int)$date2[0];
            echo $date3[0].'/'.$date3[1].'/'.$date3[2].' > '. $date[1];
                }
    // }

   
}

?> 
