<?php

include('layout/connect.php');



//echo $select;
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=order.csv');
$output = fopen('php://output', 'w');


//fputcsv($output, array('number', 'TaskName', 'Status','Priority','Website','Length','AnchoreText','LandingPage','Citation','AdditionalInfo','Deadline','ActualDeadline','DeliveryFormate'));
//$query = mysql_query("select task.*, user_master.firstname, user_master.lastname, category_master.cate_name, post_master.post_title from project  INNER JOIN user_master ON (project.client_id = user_master.id) INNER JOIN category_master ON (project.category=category_master.id) INNER JOIN post_master ON (project.training_link=post_master.id) where project.id IN (".$_GET["id"].")");
//echo "select project.*, user_master.firstname, user_master.lastname, category_master.cate_name, post_master.post_title from project  INNER JOIN user_master ON (project.client_id = user_master.id) INNER JOIN category_master ON (project.category=category_master.id) INNER JOIN post_master ON (project.training_link=post_master.id) where project.id IN (".$_GET["id"].")";


fputcsv($output, 
        array('id', 'invoice_no', 'invoice_date', 'customer_id', 'product_id', 
              'order_quantity','total_price', 'discount', 'discount_type', 'final_total', 
              'status', 'active', 'indi_price', 'indi_total','created_on')
        );

$count = 1;

$select_table = mysqli_query($conn,"SELECT * FROM `order_details` where status='7' and active =1");
while ($rows = mysqli_fetch_array($select_table)) {
    
    $data1 = Array($rows['id'], $rows['invoice_no'], $rows['invoice_date'], $rows['customer_id'], $rows['product_id'], 
                   $rows['order_quantity'],$rows['total_price'], $rows['discount'], $rows['discount_type'], $rows['final_total'], 
                   $rows['status'], $rows['active'], $rows['indi_price'], $rows['indi_total'],$rows['created_on']);
                   
    getcsv($data1);
}



// get total number of fields present in the database
function getcsv($no_of_field_names) {
    $separate = '';
// do the action for all field names as field name
    foreach ($no_of_field_names as $field_name) {
        if (preg_match('/\\r|\\n|,|"/', $field_name)) {
            $field_name = '' . str_replace('', $field_name) . '';
        }
        echo $separate . $field_name;
        $separate = ',';
    }
    echo $data;
//make new row and line
    echo "\r\n";
}

?>
