<?php include __DIR__ . '/parts/config.php'; ?>
<?php
$title = '會員註冊';
$pageName ='staff_register';
?>
<?php include __DIR__ . '/parts/staff_html-head.php'; ?>
<style>
    body {
        background: linear-gradient(45deg, #e1ebdc 0%, #e8ddf1 100%);
    }

    .con_01 {
        border-radius: 0.25rem;

        box-shadow: 0px 0px 15px #666E9C;
        -webkit-box-shadow: 0px 0px 15px #666E9C;
        -moz-box-shadow: 0px 0px 15px #666E9C;
    }

    form .form-group small.error {
        color: red;
    }

    .btnGroup button.facebook {
        background-color: #3b5998;
    }

    .btnGroup button.twitter {
        background-color: #1da1f2;
    }

    .btnGroup button.google {
        background-color: #dd4b39;
    }

    span {
        color: rgb(224, 100, 100);
        font-size: 0.8rem;
    }

    .container {
        margin: 5% auto;
    }

    .button {
        text-align: center;
    }

    form {
        color: gray;
        padding: 5% 7.5%;
        background: white;
        font-weight: 600;

    }

    .form-group ::-webkit-input-placeholder {
        color: #a4b0be;
    }
/* =============================== modal =============================== */



    .bee svg{
        width: 100px;
        height:100px;
        margin:1rem;
    }



</style>

<?php include __DIR__ . '/parts/staff_navbar.php'; ?>
<main>
    <!-- ===============================  modal - 確認登入 =============================== -->
    
    <?php include "parts/modal.php"?>
    <div class="container ">
        <div class="row justify-content-center  ">
            <div class="col-7 con_01 m-0 p-0">
                <h2 class="title b-green rot-135">修改密碼</h2>
                <form name="form1" method="post" novalidate onsubmit="checkForm(); return false;">
                    <input type="hidden" name="action" value="changePassword"/>
                    <div class="form-group">
                        <label for="password">密碼 <span>(必填)</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="＊＊＊＊＊＊" required>
                        <small class="form-text error"></small>
                    </div>
                    <div class="button m-4"><button type="submit" class="custom-btn btn-4 t_shadow ">註冊</button></div>
                    <hr>
                </form>
            </div>
        </div>
    </div>

</main>
<?php include __DIR__ . '/parts/staff_scripts.php'; ?>
<script>
    const fileds = [];


    function checkForm() {
        // 回復原來的狀態
        fileds.forEach(el => {
            el.css('border', '1px solid #CCCCCC');
            el.next().text('');
        });

        let isPass = true;

        if (isPass) {
            $.post(
                'staff-api.php',
                $(document.form1).serialize(),
                function(data) {
                    console.log(data);
                    if (data.success) {
                        modal_init();
                        insertPage("#modal_img", "animation_login.html");
                        insertText("#modal_content", "修改成功");
                        $("#modal_alert").modal("show");
                        setTimeout(function(){window.history.back();}, 2000);
                        // alert('註冊成功');
                        //window.history.back();
                    } else {
                        alert(data.error);
                    }
                },
                'json'
            ).fail(function(d){
                alert(d);
                console.log(d);
            })
        }

    }
</script>
<?php include __DIR__ . '/parts/staff_html-foot.php'; ?>