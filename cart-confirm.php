<?php include __DIR__. '/parts/config.php'; ?>
<?php
$title = '感謝購買';
$pageName = 'cart-confirm';

if(
        ! isset($_SESSION['user'])
        or
        empty($_SESSION['cart'])
){
    header('Location: index.php');
    exit;
}
$sum = 0;
?>
<?php include __DIR__ . '/parts/html-head.php'; ?>

<style>
    body {
        background: linear-gradient(45deg, #e8ddf1 0%, #e1ebdc 100%);
        position: relative;
        z-index: -10;

    }

     .con_01{
        box-shadow: 0px 0px 15px #666E9C;
        -webkit-box-shadow: 0px 0px 15px #666E9C;
        -moz-box-shadow: 0px 0px 15px #666E9C;
    }

    .card img{
        width:2.5rem;
    }
    .orderStatus div{
        margin:1rem;
        
    }
</style>
<?php include __DIR__ . '/parts/navbar.php'; ?>
<div class="container mt-5 mb-5  ">
    <div class="card  row mb-5 con_01" >
        <div class="card-body" >
            <h3 class=" b-green rot-13 p-2 title"><img src="./images/icon/leaf_L.svg" alt="">&emsp;感謝您的訂購！期待與您在薰衣草相見喔！&emsp;<img src="./images/icon/leaf_R.svg" alt=""></h3> 
            <p class="p-4 text-secondary">⚠️提醒您⚠️最近網路詐騙猖獗，您完成下訂後（或是從沒下訂過），我們都不會以電話通知您更改付款方式、 或是要求給予銀行帳號及密碼。若有接到此類電話且非安珂客服專線02-25962996撥打
    　請勿理會🚫🚫🚫或撥打165反詐騙專線、165反詐騙APP報案！<br><br>若有任何問題請私訊薰衣草森林粉絲團或官方LINE詢問，也可於上班時間（週一至週日9:30-18:00）撥打客服電話詢問：</p>

        </div>
    </div>
    <div class="row card con_01 ">
        <div class="col-12 pt-4 text-secondary">
            <h4>訂單編號：<span id="order_id"></span></h4> 
        </div>
        <div class="col-12  ">
            <?php if (empty($_SESSION['cart']['event']) && empty($_SESSION['cart']['restaurant']) && empty($_SESSION['cart']['hotel'])) : ?>
                <div class="alert alert-danger" role="alert">
                    目前購物車裡沒有商品, 請至商品列表選購
                </div>

            <?php else: ?>
                <?php if (!empty($_SESSION['cart']['event'])): ?>
                    <table class="table table-striped table-bordered" id="event_table">
                        <thead>
                            <h4 class=" title b-green rot-135">訂單明細 - 活動</h4>
                            <tr class="b-green rot-135 text-white">
                                <th scope="col" class="m-0 t_shadow text-center">
                                    項目名稱
                                </th>
                                <th scope="col" class="m-0 t_shadow text-center">日期／時間</th>
                                <th scope="col" class="m-0 t_shadow text-center">數量</th>
                                <th scope="col" class="m-0 t_shadow text-center">單價</th>
                                <th scope="col" class="m-0 t_shadow text-center">小計</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php if (!empty($_SESSION['cart']['restaurant'])): ?>
                    <table class="table table-striped table-bordered" id="restaurant_table">
                        <thead>
                            <h4 class=" title b-green rot-135">訂單明細 - 餐廳</h4>
                            <tr class="b-green rot-135 text-white">
                                <th scope="col" class="m-0 t_shadow text-center">
                                    訂位日期
                                </th>
                                <th scope="col" class="m-0 t_shadow text-center">訂位時段</th>
                                <th scope="col" class="m-0 t_shadow text-center">訂位人數</th>
                                <th scope="col" class="m-0 t_shadow text-center">訂位桌號</th>
                                <th scope="col" class="m-0 t_shadow text-center">單價</th>
                                <th scope="col" class="m-0 t_shadow text-center">小計</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                <?php endif; ?>
                <?php if (!empty($_SESSION['cart']['hotel'])): ?>
                    <table class="table table-striped table-bordered" id="hotel_table">
                        <thead>
                            <h4 class=" title b-green rot-135">訂單明細 - 活動</h4>
                            <tr class="b-green rot-135 text-white">
                                <th scope="col" class="m-0 t_shadow text-center">
                                    項目名稱
                                </th>
                                <th scope="col" class="m-0 t_shadow text-center">日期</th>
                                <th scope="col" class="m-0 t_shadow text-center">數量</th>
                                <th scope="col" class="m-0 t_shadow text-center">人數</th>
                                <th scope="col" class="m-0 t_shadow text-center">單價</th>
                                <th scope="col" class="m-0 t_shadow text-center">小計</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                <?php endif; ?>
                <div class="alert alert-primary text-center" role="alert">
                     <h4 class="m-0"> 原價: <span class="originalPrice"></span> - 折扣: <span class="discountPrice"></span> = 總計: <span class="totalPrice"></span></h4>
                </div>

                <div class="orderStatus text-secondary ">
                    <div> 
                        <h4>訂單狀態</h4>
                        <p>顯示訂單處理中/已完成交易</p>
                    </div>
                    <div>
                        <h4>收件人資料</h4>
                        <p>顯示cart.php留的資訊</p>
                    </div>
                    <div>
                    <h4>付款方式</h4>
                        <p>顯示cart.php留的資訊</p>
                    </div>
                    <div>
                        <h4>付款狀態</h4>
                        <p>顯示已付款/未付款</p>
                    </div>
                    <div>
                        <h4>物流狀態</h4>
                        <p>顯示備貨/出貨</p>
                        <P>物流公司：</P>
                        <P>物流編號：</P>
                        <P>查詢網址：</P>
                    </div>
                </div>
            <?php endif;?>

        <div class="mb-5 text-center">
            <a href="index.php" class="custom-btn btn-4 text-center m-3">回首頁</a>
            <a href="member.php?tab=tradeRecord"  class="custom-btn btn-4 text-center m-3">查詢訂單紀錄</a>
        </div>
    </div>

</div>
</div>


<?php include __DIR__. '/parts/scripts.php'; ?>
<script>
$(document).ready(function(){
    function updateFormContainer(){
        $(".form-container").hide();
        $('input[type="radio"]:checked').each(function(i, elem){
            
            var targetBox = $("." + elem.value);
            $(targetBox).show();
        });
        
    }
    $('input[type="radio"]').click(updateFormContainer);
    $('input[type="radio"]').click(isCompletedPayWayData);
    updateFormContainer();
    isCompletedUserData();
    isCompletedPayWayData();
    fillTable();
});
function isCompletedUserData(){
    $.post('member-api.php', {
        'action': 'isCompletedUserData',
    }, function(data){
        
        console.log(data);
        result = data[0];
        if (!result) {
            $("#checkOutBtn").addClass("disabled");
            $("#warning_msg").show();
        }else{
            $("#checkOutBtn").removeClass("disabled");
            $("#warning_msg").hide();
        }
    }, 'json').fail(function(e){
        console.log("error");
        console.log(e);
    });
}

function isCompletedPayWayData(){
    var checked_count = $("input[name='payway']:checked").length + $("input[name='name']:checked").length;
    if (checked_count == 2){
        $("#checkOutBtn").removeClass("disabled");
        $("#warning_msg_payway").hide();
    }else{
        $("#checkOutBtn").addClass("disabled");
        $("#warning_msg_payway").show();
    }
}

function fillTable(){
    var url_string = window.location.href
    var url = new URL(url_string);
    var id = url.searchParams.get("id");
    $.post('order-api.php', {
        'action': 'readOne',
        id
    }, function(data){
        console.log("fileTable");
        console.log(data);

        data['event'].forEach(function(elem){
            var id = 0; //elem['id'];
            var name = elem['name'];
            var order_datetime = elem['order_datetime'];
            var quantity = elem['quantity'];
            var price = elem['price'];
            var sub_total = elem['sub_total'];
            
            tr = `<tr>
                    <td><a href="event.php#event_${id}">${name}</a></td>
                    <td>${order_datetime}</td>
                    <td>${quantity}</td>
                    <td class="event_price">$ ${price}</td>
                    <td class="event_sub-total">$ ${sub_total}</td>
                </tr>`;
            $('#event_table tbody').append(tr);
        });
        data['restaurant'].forEach(function(elem){
            tr = `<tr data-sid="${elem['id']}">
                                    <td>${elem['order_date']}</td>
                                    <td>${elem['order_time']}</td>
                                    <td>${elem['quantity']}</td>
                                    <td>${elem['id']}</td>
                                    <td class="restaurant_price">$0</td>
                                    <td class="restaurant_sub-total">$<?= intval(0) * 100 ?></td>
                                </tr>`;
            $('#restaurant_table tbody').append(tr);
        });
        data['hotel'].forEach(function(elem){
            tr = `<tr data-sid="${elem['id'] }">
                                    <td>${elem['name_zh'] }</br>${elem['name_en'] }</td>
                                    <td>${elem['order_date']}</td>
                                    <td>${elem['quantity'] }</td>
                                    <td>${elem['people_num'] }</td>
                                    <td class="hotel_price">$ ${elem['price'] }</td>
                                    <td class="hotel_sub-total">$ ${elem['sub_total']}</td>
                                </tr>`;
            $('#hotel_table tbody').append(tr);
        });
         $("#order_id").text( data['order']['order_id']);
         $(".originalPrice").text( data['order']['original_price']);
         $(".discountPrice").text( data['order']['discount']);
         $(".totalPrice").text( data['order']['price']);

    }, 'json').fail(function(e){
        console.log("error");
        console.log(e.responseText);
    });

}
</script>

<?php include __DIR__ . '/parts/html-foot.php'; ?>
<?php unset($_SESSION['cart'])?>
<?php // unset($_SESSION['cart'])?>