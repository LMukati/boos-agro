<?php
include('layout/connect.php');

$order_id = $_GET["id"];

$order = mysqli_query($conn,"select * from order_details where id= $order_id") ;
$order_detail = mysqli_fetch_array($order);

$custo = mysqli_query($conn,"select * from users where id= '".$order_detail["customer_id"]."'") ;
$customer =  mysqli_fetch_array($custo);

$custo1 = mysqli_query($conn,"select * from users where id= '".$customer["allot_to"]."'") ;
$salesperson =  mysqli_fetch_array($custo1);

$ifcreate = '' ;
if($order_detail["created_by"])
{
    $creat = mysqli_query($conn,"select * from users where id= '".$order_detail["created_by"]."'") ;
    $creater =  mysqli_fetch_array($creat);
    
    $ifcreate .= '<div class="col invoice-to">';
    $ifcreate .= '                    <div class="text-gray-light">Order Created By:</div>';
    $ifcreate .= '                    <h2 class="to">'.$creater["first_name"].' '.$creater["last_name"].'</h2>';
    $ifcreate .= '                    <div class="address">'.$creater["village"].'</div>';
    $ifcreate .= '                    <div class="email">'.$creater["email"].'</div>';
   $ifcreate .= '                 </div>';
}
else{
    $ifcreate = '';
}
?>


<?php



$product_html = '';

$order_product = mysqli_query($conn,"select * from order_product where order_id= $order_id") ;

$gst = 0 ;
$total_price = 0 ;
$ro = 1;

while($allorder = mysqli_fetch_array($order_product)){

$product_html .= '<tr>';
$product_html .= '    <td class="no">'.$ro.'</td>';
$product_html .= '    <td class="unit"><h3><a href="#">' ;

$dproid = $allorder['product_id'] ; 
$Dproduct = mysqli_query($conn,"select * from product where id = $dproid") ;
$Dproductn = mysqli_fetch_array($Dproduct);
$product_html .=  $Dproductn["product_name"] ;

$product_html .= '</a></h3></td>';
$product_html .= '    <td class="qty">'.$allorder["unit"].'</td>';
$product_html .= '    <td class="unit">'.$allorder["price"].'</td>';
$product_html .= '    <td class="qty">'.$allorder["quantity"].'</td>';
$product_html .= '    <td class="total">'.$allorder["total_price"].'</td>';
$product_html .= '</tr>';  

$ro++;

$gst += $allorder["total_price"]*$Dproductn["gst"]/100 ;
$total_price += $allorder["total_price"] ;
}

$grand_total = $total_price + $gst ;

if($order_detail["discount_type"]){
    $grand_total = $grand_total - $order_detail["discount"] ;
}    



$product_html .= '</tbody>';
$product_html .= '<tfoot>';
$product_html .=    '<tr>';
$product_html .=        '<td colspan="3"></td>';
$product_html .=        '<td colspan="2">SUBTOTAL</td>';
$product_html .=        '<td>'.$total_price.'</td>';
$product_html .=    '</tr>';
$product_html .=    '<tr>';
$product_html .=        '<td colspan="3"></td>';
$product_html .=        '<td colspan="2">GST</td>';
$product_html .=        '<td>'.$gst.'</td>';
$product_html .=    '</tr>';

if($order_detail["discount_type"]){
$product_html .=    '<tr>';
$product_html .=        '<td colspan="3"></td>';
$product_html .=        '<td colspan="2">Discount ('.$order_detail["discount_type"].')</td>';
$product_html .=        '<td>'.$order_detail["discount"].'</td>';
$product_html .=    '</tr>';   
}

$product_html .=    '<tr>';
$product_html .=        '<td colspan="3"></td>';
$product_html .=        '<td colspan="2">GRAND TOTAL</td>';
$product_html .=        '<td>'.$grand_total.'</td>';
$product_html .=   '</tr>';
$product_html .=    '<tr>';
$product_html .=        '<td colspan="3"></td>';
$product_html .=        '<td colspan="2">PAYMENT METHOD</td>';
$product_html .=        '<td>'.$order_detail["payment_method"].'</td>';
$product_html .=   '</tr>';
$product_html .= '</tfoot>';

?>





<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>



<div id="invoice">

    <div class="toolbar hidden-print">
        <div class="text-right">
            <button class="btn btn-warning" onclick="window.history.back()"><i class="fa fa-return"></i> Back</button>
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
        </div>
        <hr>
    </div>
    
<?php

echo    $message = '<div class="invoice overflow-auto" id="content">
        <div style="min-width: 600px">
            <header>
           <div style="text-align:center;"><h1> ORDER FORM</h1></div>
                <div class="row">
                    <div class="col">
                        <a target="_blank" href="https://lobianijs.com">
                            <img src="https://bossagro.com/images/logo.png" data-holder-rendered="true" style="    height: 100px;" />
                            </a>
                    </div>
                    <div class="col company-details">
                        <h2 class="name">
                            <a target="_blank" href="https://bossagro.com/">Boss Agro Chemical Pvt. Ltd.</a>
                        </h2>
                        <div>473, Sarvodaya Nagar, Near Hablani Parisar, Sapna Sangeeta Road, Indore - 452001 (M.P.)</div>
                        <div>0731-2468111, 4274888</div>
                        <div>bossagrochem@gmail.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                <div class="col invoice-to">
                  <h4>Order Date: '.$_GET["date"].'</h4><br>
                    <h4>Order ID: '.$_GET["id"].'</h4>
                    </div>
                    
                   <div class="col invoice-to">
                   
                   
                        <div class="text-gray-light">TO:</div>
                        Firm Name : '.$customer["firm_name"].'
                        <div class="address">Name : '.$customer["first_name"].'</div>
                        <div class="address">Address : '.$customer["village"].'</div>
                        <div class="address">Mobile : '.$customer["phone"].'</div>
                        <div class="email">Email : '.$customer["email"].'</div>
                    </div>
                    <div class="col invoice-to">
                        <div class="text-gray-light">Sales Person:</div>
                        <div class="to">Name: '.$salesperson["first_name"].'</div>
                        <div class="address">Mobile: '.$salesperson["phone"].'</div>
                       
                    </div>
                    '.$ifcreate.'
                   
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-right">Product</th>
                            <th class="text-right">Unit</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    '.$product_html.'
                    
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
            </main>
            <footer>
                for any issue contact to boss agro office.
            </footer>
        </div>
        <div></div>
    </div>';
    
?>    
    
</div>

<script>
     $('#printInvoice').click(function(){
            Popup($('#content')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
</script>
