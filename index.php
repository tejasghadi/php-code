<?php
namespace Iksula\Campaign\Model\September2019;
use  Iksula\Campaign\Api\September2019\BraCampaignInterface;

class BraCampaign implements BraCampaignInterface
{

  /**
     * GoogleAnalytics
     * @author : NKR
     *
     * @api
     * @param float cupsize
     * @param float bandsize
     * @return string message
     */

  public function __construct(
    \Magento\Framework\App\ResourceConnection $resource,
    \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
  ) {

    $this->scopeConfig      = $scopeConfig;
    $this->resource         = $resource;

  }
  public function SizeProvider($underband,$bust,$store_id){

    $min_underband = 59.7;
    $max_underband = 97.9;
    $min_bust      = 70.0;
    $max_bust      = 128.3;
    $arabic = array(1,3,5);

    if(($min_underband <= $underband && $max_underband >= $underband) && ($min_bust <= $bust && $max_bust >= $bust)) {

        $equivalentBand = 0;

        if    ($underband >= 59.7 && $underband <= 62.3){ $equivalentBand = 28; }
        elseif($underband >= 62.4 && $underband <= 67.4){ $equivalentBand = 30; }
        elseif($underband >= 67.5 && $underband <= 72.5){ $equivalentBand = 32; }
        elseif($underband >= 72.6 && $underband <= 77.5){ $equivalentBand = 34; }
        elseif($underband >= 77.6 && $underband <= 82.7){ $equivalentBand = 36; }
        elseif($underband >= 82.8 && $underband <= 87.7){ $equivalentBand = 38; }
        elseif($underband >= 87.8 && $underband <= 92.8){ $equivalentBand = 40; }
        elseif($underband >= 92.9 && $underband <= 97.9){ $equivalentBand = 42; }
        else
          {
            if(in_array($store_id, $arabic)){
              echo json_encode(array('code' => 200,'status' => 0,'message' => "قياس الحزام غير صحيح"));
            }else{
              echo json_encode(array('code' => 200,'status' => 0,'message' => "UnderBand size out of range"));
            }
            exit;
          }

    $equivalentBust = 0;

    if    ( $bust >= 70.0  && $bust <= 72.5 ){ $equivalentBust = 28; }
    elseif( $bust >= 72.6  && $bust <= 75.0 ){ $equivalentBust = 29; }
    elseif( $bust >= 75.1  && $bust <= 77.5 ){ $equivalentBust = 30; }
    elseif( $bust >= 77.6  && $bust <= 80.1 ){ $equivalentBust = 31; }
    elseif( $bust >= 80.2  && $bust <= 82.6 ){ $equivalentBust = 32; }
    elseif( $bust >= 82.7  && $bust <= 85.2 ){ $equivalentBust = 33; }
    elseif( $bust >= 85.3  && $bust <= 87.7 ){ $equivalentBust = 34; }
    elseif( $bust >= 87.8  && $bust <= 90.2 ){ $equivalentBust = 35; }
    elseif( $bust >= 90.3  && $bust <= 92.8 ){ $equivalentBust = 36; }
    elseif( $bust >= 92.9  && $bust <= 95.4 ){ $equivalentBust = 37; }
    elseif( $bust >= 95.5  && $bust <= 97.9 ){ $equivalentBust = 38; }
    elseif( $bust >= 98.0  && $bust <= 100.4){ $equivalentBust = 39; }
    elseif( $bust>= 100.5  && $bust <= 102.9){ $equivalentBust = 40; }
    elseif( $bust>= 103.0  && $bust <= 105.5){ $equivalentBust = 41; }
    elseif( $bust>= 105.6  && $bust <= 108.0){ $equivalentBust = 42; }
    elseif( $bust>= 108.1  && $bust <= 110.6){ $equivalentBust = 43; }
    elseif( $bust>= 110.7  && $bust <= 113.1){ $equivalentBust = 44; }
    elseif( $bust>= 113.2  && $bust <= 115.6){ $equivalentBust = 45; }
    elseif( $bust>= 115.7  && $bust <= 118.2){ $equivalentBust = 46; }
    elseif( $bust>= 118.3  && $bust <= 120.7){ $equivalentBust = 47; }
    elseif( $bust>= 120.8  && $bust <= 123.3){ $equivalentBust = 48; }
    elseif( $bust>= 123.4  && $bust <= 125.8){ $equivalentBust = 49; }
    elseif( $bust>= 125.9  && $bust <= 128.3){ $equivalentBust = 50; }
    else
      {
        if(in_array($store_id, $arabic)){
              echo json_encode(array('code' => 200,'status' => 0,'message' => "قياس الصدر غير صحيح"));
        }else{
          echo json_encode(array('code' => 200,'status' => 0,'message' => "Bust size out of range"));
        }
        exit;
      }
    if($equivalentBust != 0 && $equivalentBand != 0){

      $differenceBtwBustAndUnder = $equivalentBust - $equivalentBand;
    }
    else{
      if(in_array($store_id, $arabic)){
        echo json_encode(array('code' => 200,'status' => 0,'message' => "القياس غير صحيح"));
      }else{
        echo json_encode(array('code' => 200,'status' => 0,'message' => "size out of range"));
      }
      exit;
    }

    if    ($differenceBtwBustAndUnder <= 0.0){$cupsize = 'AA';}
    elseif($differenceBtwBustAndUnder == 1.0){$cupsize = 'A'; }
    elseif($differenceBtwBustAndUnder == 2.0){$cupsize = 'B'; }
    elseif($differenceBtwBustAndUnder == 3.0){$cupsize = 'C'; }
    elseif($differenceBtwBustAndUnder == 4.0){$cupsize = 'D'; }
    elseif($differenceBtwBustAndUnder == 5.0){$cupsize = 'DD';}
    else{
      if(in_array($store_id, $arabic)){
        echo json_encode(array('code' => 200,'status' => 0,'data' => '','message' => "الاختلاف بين قياس الحزام والصدر غير صحيح"));
      }else{
        echo json_encode(array('code' => 200,'status' => 0,'data' => '','message' => "Difference between Bust And Underband out of range"));
      }
       exit;
    }
 $connection = $this->resource->getConnection();
 $eav_attribute_option_value = $this->resource->getTableName('eav_attribute_option_value');

 $sql = "SELECT option_id,value  FROM `eav_attribute_option_value` WHERE `value` LIKE '%".$equivalentBand."%' AND store_id = ".$store_id;

 if($result = $connection->fetchAll($sql)){
  foreach ($result as $key => $data) {
    $bra_size = explode("/",$data['value']);
    if($bra_size[0] == $equivalentBand){
      $arr = preg_split('/(?<=[0-9])(?=[a-z]+)/i',$bra_size[1]);
      if(isset($arr[1]) && $arr[1] == $cupsize){
        $value = $data['option_id'];
        $name = $data['value'];
        $result = array('name'=>$name,'value'=>$value,'code'=>'size','isActive'=>false);
        $braData[] = array('code' => 200,'status' => 1,'data' => $result,'display_name'=>$equivalentBand.$cupsize);
      }
      else{
          $braData[] = array('code' => 200,'status' => 0,'message' => "Cup size not found",'display_name'=>$equivalentBand.$cupsize);
      }
    }
    else{
        $braData[] = array('code' => 200,'status' => 0,'message' => "Band size not found",'display_name'=>$equivalentBand.$cupsize);
    }

  }
}
$res = '';
foreach ($braData as $key => $value) {
if($value['status'] ==1){
  echo json_encode($value);
  exit();
}
else{
  $res = $value;
  continue;
}

}
if(in_array($store_id, $arabic)){
echo json_encode(array('code' => 200,'status' => 0,'data' => '','data' => $res,'display_name'=>$equivalentBand.$cupsize));
}else{
echo json_encode(array('code' => 200,'status' => 0,'data' => '','data' => $res,'display_name'=>$equivalentBand.$cupsize));
}
       exit;

}else{
  if(in_array($store_id, $arabic)){
    echo json_encode(array('code' => 200,'status' => 0,'message' => "قياس الصدر غير صحيح"));
    exit;
  }else{
    echo json_encode(array('code' => 200,'status' => 0,'message' => "size out of range"));
    exit;
  }
}

}

  public function sendsms($mobile, $store_id, $size)
  {
    $url = $this->scopeConfig->getValue('smscredentials/credentialsData/apiurl');
    $merchantref = $this->scopeConfig->getValue('smscredentials/credentialsData/merchantref');
    $merchantsecret = $this->scopeConfig->getValue('smscredentials/credentialsData/merchantsecret');
    $smsenglish = $this->scopeConfig->getValue('smscredentials/credentialsData/smsenglish');
    $smsarabic = $this->scopeConfig->getValue('smscredentials/credentialsData/smsarabic');
    $smsenglish = str_replace("{size}",$size,$smsenglish);
    $smsarabic = str_replace("{size}",$size,$smsarabic);
    // echo $smsarabic."---".$smsenglish;exit;
    $msg = $smsenglish; /////////////////// exit;
    if(in_array($store_id,array(1,3,5))){
      $msg = $smsarabic;
    }
    // echo      $msg;exit;
    if($url == '' || $merchantref == '' || $merchantsecret == '' || $smsenglish == '' || $smsarabic == '' ){
      $response['status'] = false;
      $response['code'] = 200;
      $response['data'] = 'Some issue occur.';
      echo json_encode($response);
      exit;
    }

    $request = array("merchantref"=>$merchantref,
        "merchantsecret"=>$merchantsecret,
        "mobile"=>$mobile,
        "msg"=>$msg);
    $requestJson = json_encode($request);
    try {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $requestJson);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($curl);
        // print_r($response);exit;
        $err = curl_error($curl);
        curl_close($curl);

        $response = json_decode($response, true);


        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/smstest.log');
$logger = new \Zend\Log\Logger();
$logger->addWriter($writer);
$logger->info($response['status']);
        if($response['status'] == 200) {
          $response['status'] = true;
          $response['code'] = 200;
          echo json_encode($response);
          exit;
        }else{
          $response['status'] = false;
          $response['code'] = 400;
          echo json_encode($response);
          exit;
        }
    } catch (Exception $e) {
      $response['status'] = false;
      $response['code'] = 400;
      $response['data'] = $e->getMessage();
      echo json_encode($response);
      exit;
    }
  }

}
