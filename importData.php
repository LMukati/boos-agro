<?php
session_start();
  include('layout/connect.php');
   include 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
  // print_r($_POST);die;
if(isset($_POST['importSubmit']))
 {
    $type=$_POST['type'];
    //print_r($_FILES);
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel',$_FILES['file']['type'], 'application/vnd.msexcel', 'text/plain');
   // print_r($csvMimes);
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes))
        {
          echo $_FILES['file']['name'];
         
          $target_dir = "xls/";
            $target_file = $target_dir . basename($_FILES['file']['name']);
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
           // print_r($target_file); die; 
            // Check if image file is a actual image or fake image
             if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
               // echo "The file ". basename( $_FILES['file']['name']). " has been uploaded.";
            } 
            else {
                //echo "Sorry, there was an error uploading your file.";
            }
           
          $inputFileName = "xls/".$_FILES['file']['name'];

          //  Read your Excel workbook
          try {
              $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
              $objReader = PHPExcel_IOFactory::createReader($inputFileType);
              $objPHPExcel = $objReader->load($inputFileName);
          } catch(Exception $e) {
              die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
          }
          
          //  Get worksheet dimensions
          $sheet = $objPHPExcel->getSheet(0); 
          $highestRow = $sheet->getHighestRow(); 
          $highestColumn = $sheet->getHighestColumn();
          echo $highestRow;
          $raw=1;

          $count=1;
          //  Loop through each row of the worksheet in turn
          for ($row = 1; $row <= $highestRow; $row++){ 
              //  Read a row of data into an array
              $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                              NULL,
                                              TRUE,
                                              FALSE);               
              
              if($count == 1){

              }else{

              if($type==1)
              {
                $sql = "INSERT INTO raw_material (raw_name, raw_quantity,raw_unit,raw_price)
                VALUES ('".$rowData[0][0]."', '".$rowData[0][1]."', '".$rowData[0][2]."','".$rowData[0][3]."')";
                if (mysqli_query($conn, $sql)) {
                   header('Location: import.php?value=succ');
                } else {
                  header('Location: import.php?value=err');  
                }

              }
              elseif($type==2)
              {
               //echo "<pre>", print_r($rowData[0]);
                  if($rowData[0][0] !='')
                      

                                $pcode = $rowData[0][0];
                                $nm1 = $rowData[0][1] ;
                                $tnm1 = $rowData[0][2] ;
                                $batcode1 = $rowData[0][3] ;
                                $mdate1 = $rowData[0][4] ;
                                $edate1 = $rowData[0][5] ;
                                $gst = $rowData[0][6] ;
                                $qty1 = $rowData[0][7] ;
                                $prc1 = $rowData[0][8] ;
                                $rwId1 = $rowData[0][9];
                                $rwmt = $rowData[0][10] ;
                                $pimg = $rowData[0][11] ;
                                $disc = $rowData[0][12] ;
                               // echo  $sql; 
                        $sql = "INSERT INTO product (product_code,product_name,  p_technical_name ,batch_code,manufacturing_dt,  expiry_dt,gst,product_price,product_img,hsn_code,unit,packaging,pro_discription)
                                             VALUES ('".$pcode."','".$nm1."','".$tnm1."','".$batcode1."','".$mdate1."','".$edate1."','".$gst."', '".$qty1."', '".$prc1."','".$rwId1."','".$rwmt."','".$pimg."','".$disc."')";
                      //echo "<pre>", print_r( $sql);
                          $result= mysqli_query($conn, $sql);
              }
              
                 
           }
          $count++;
        }//die;
          if($type==2)
            {
          if(isset($result)){
                  // echo "string";die;
                  echo "<script> alert('Product Import Successfully!'); history.back(); </script>";
                  // header('Location:import.php?value=succ');
                   //exit();


                } else {
                 // echo "ddddd";die;
                 echo "<script> window.location.href = import.php?value=err </script>"; 
                }
              }
            
   
    
  

// if(isset($qstring4))
// {
//   //echo $arg; die()
//     //redirect to the listing page
//   header("Location: register.php".$qstring4);
// }
// elseif(isset($qstring3))
// {
//     //redirect to the listing page
// header("Location: register.php".$qstring3);
// }
// else{
  
// header("Location: register.php".$qstring);
// }
  }
}
