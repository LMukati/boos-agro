<?php
include('layout/connect.php');

$order_id = $_GET["id"];

$digits = 4;
$invoice_id = rand(pow(10, $digits-1), pow(10, $digits)-1);

$update_invoice = mysqli_query($conn,"update order_details set 	invoice_no = '$invoice_id',	invoice_date = '".date('Y-m-d')."' where id = '$order_id'");

$order = mysqli_query($conn,"select * from order_details where id= $order_id") ;
$order_detail = mysqli_fetch_array($order);

$custo = mysqli_query($conn,"select * from users where id= '".$order_detail["customer_id"]."'") ;
$customer =  mysqli_fetch_array($custo);

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
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button> 
            <button class="btn btn-info" id="cmd"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
<?php

echo    $message = '<div class="invoice overflow-auto" id="content">
        <div style="min-width: 600px">
            <header>
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
                        <div class="text-gray-light">INVOICE TO:</div>
                        <h2 class="to">'.$customer["shop"].'</h2>
                        <div class="address">'.$customer["village"].'</div>
                        <div class="email">'.$customer["email"].'</div>
                    </div>
                    <div class="col invoice-details">
                        <h1 class="invoice-id">INVOICE : '.$invoice_id.'</h1>
                        <div class="date">Date of Invoice: '.$date = date("d-m-Y").'</div>
                    </div>
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

<?php

require_once 'MPDF/vendor/autoload.php';
                 $mpdf = new mPDF('c');
                 $mpdf->WriteHTML($message);
                 $mpdf->Output('invoice.pdf','F');

?>

<style>
     $('#printInvoice').click(function(){
            Popup($('.invoice')[0].outerHTML);
            function Popup(data) 
            {
                window.print();
                return true;
            }
        });
</style>
<script>
$('#cmd').click(function () { 
    var element = $("#content"); // global variable
    var getCanvas; // global variable
     
    html2canvas(element, {
         onrendered: function (canvas) {
                //$("#editor1").append(canvas);
                getCanvas = canvas;
                var imgageData = getCanvas.toDataURL("image/png");
                    // Now browser starts downloading it instead of just showing it
                    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
                    $("#out1").attr("alt", "your_pic_name.png").attr("src", newData);
                    
                    var pdf = new jsPDF();
                    pdf.addImage(newData, 'png', 0, 0);
                    pdf.save('screenshot.pdf');
             }
    });


    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    doc.fromHTML($('#content').html(), 15, 15, {
        'elementHandlers': specialElementHandlers
    });
   doc.save('sample-file.pdf');
   
    
});
</script>