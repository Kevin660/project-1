<?php include __DIR__ . '/parts/config.php'; ?>
<?php
$title = '會員註冊';
$pageName ='staff_register';
?>
<?php include __DIR__ . '/parts/staff_html-head.php'; ?>
<style>
    body {
        background: linear-gradient(45deg, #e8ddf1 0%,  #e1ebdc 100%);
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
            <div class="col-md-7 con_01 m-0 p-0">
                <h2 class="title b-green rot-135">新增員工</h2>
                <form name="form1" method="post" onsubmit="checkForm(); return false;">
                    <input type="hidden" name="action" value="admin_register"/>
                    <div class="form-group">
                        <label for="quantity">人數 <span>(必填)</span></label>
                        <input type="text" class="form-control" id="quantity" name="quantity" min=1 autofocus required>
                        <small class="form-text error"></small>
                    </div>
                    <div class="form-group">
                        <label for="role">類型<span>(必填)</span></label>
                        <select type="text" class="form-control" id="role" name="role" autofocus required>
                            <option value="">請選擇</option>
                            <option value="1">管理者</option>
                            <option value="2">經理</option>
                            <option value="3">會計</option>
                            <option value="3">一般員工</option>
                        </select>
                        <small class="form-text error"></small>
                    </div>
                    <div class="button m-4"><button type="submit" class="custom-btn btn-4 t_shadow ">註冊</button></div>
                    <hr>
                </form>
            </div>
        </div>
        <div class="row justify-content-center  ">
            <div class="col-md-7 con_01 m-0 p-0">
                <h2 class="title b-green rot-135">新增結果</h2>
                <table id="result" class="table table-bordered table-Primary table-hover text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>序號</th>
                            <th>員工編號</th>
                            <th>密碼</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</main>
<?php include __DIR__ . '/parts/staff_scripts.php'; ?>
<script>
    function checkForm() {
        $.post(
            'register-api.php',
            $(document.form1).serialize(),
            function(data) {
                if (data.authError) {
                    modal_init();
                    insertPage("#modal_img", "animation_login.html");
                    insertText("#modal_content", data.authError);
                    $("#modal_alert").modal("show");
                } else if (data.success) {
                    data['data'].forEach(function(staff, index){
                    $("table#result tbody").append(`<tr>
                            <td>${index + 1}</td>
                            <td>${staff['staff_id']}</td>
                            <td>${staff['password']}</td>
                        </tr>`);
                    });
                    modal_init();
                    insertPage("#modal_img", "animation_login.html");
                    insertText("#modal_content", "新增員工成功");
                    $("#modal_alert").modal("show");
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
</script>
<?php include __DIR__ . '/parts/staff_html-foot.php'; ?>