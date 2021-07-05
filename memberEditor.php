<?php include __DIR__ . '/parts/config.php'; ?>
<?php
$title = '修改資料';
$pageName = 'editMember';

$id = intval($_SESSION['user']['id']);
$sql = "SELECT * FROM members WHERE `id`=$id";

$row = $pdo->query($sql)->fetch();
if (empty($row)) {
    header('Location: member.php');
    exit;
}


?>
<?php include __DIR__ . '/parts/html-head.php'; ?>

<?php include __DIR__ . '/parts/navbar.php'; ?>
<style>
    form .form-group small.error {
        color: red;
    }
    body {
        background: linear-gradient(45deg,#e8ddf1 0%,  #e1ebdc 100%);
    }

    .card{
        box-shadow: 0px -4px 15px #666E9C;
        -webkit-box-shadow: 0px -4px 15px #666E9C;
        -moz-box-shadow: 0px -4px 15px #666E9C;
        color: gray;
        font-size:1.2rem;
        font-weight: 600;
        padding:7.5%
    }
    input[type=text] {
        width: 100%;
        padding: 20px 20px;
        box-sizing: border-box;
        border:2px solid;
        border-image-source: linear-gradient(to left, #adda9a , #DCC5EF );
        border-image-slice: 1;
        color:#6A8AD9;
        font-weight: 500;
        font-size:1.2rem;

    }
    h2{
        box-shadow: 0px -4px 15px #666E9C;
        -webkit-box-shadow: 0px -4px 15px #666E9C;
        -moz-box-shadow: 0px -4px 15px #666E9C;
        position: relative;
        z-index: 9;
    }
</style>


<?php include "parts/modal.php"?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center ">
        <div class="col-md-6">
            <h2 class="title m-0 ">修改資料</h2>
            <div class="card">
                <form name="form1" action="memberEditor-api.php" method="post" novalidate onsubmit="checkForm(); return false;">
                    <div class="form-group">
                        <label for="fullname autofocus ">姓名</label>
                        <input type="text" class="form-control" name="fullname" id="fullname" value="<?= htmlentities($row['fullname']) ?>"></input>
                    </div>
                    <div class="form-group">
                        <label for="mobile">手機</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" pattern="09\d{2}-?\d{3}-?\d{3}" value="<?= htmlentities($row['mobile']) ?>">
                        <small class="form-text error"></small>
                    </div>
                    <div class="form-group">
                        <label for="email_2nd">備用email</label>
                        <input type="text" class="form-control" name="email_2nd" id="email_2nd" value="<?= htmlentities($row['email_2nd']) ?>"></input>
                    </div>
                    <div class="form-group">
                        <label for="county">縣市</label>
                        <select class="form-control" name="county" id="county" value="<?= htmlentities($row['county']) ?>"></select>
                    </div>
                    <div class="form-group">
                        <label for="district">鄉鎮市區</label>
                        <select class="form-control" name="district" id="district" value="<?= htmlentities($row['district']) ?>"></select>
                    </div>
                    <div class="form-group">
                        <label for="zipcode">郵遞區號</label>
                        <input required type="text" class="form-control" name="zipcode" id="zipcode" placeholder="236"  value="<?= htmlentities($row['zipcode']) ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <input required type="text" class="form-control" name="address" id="address" placeholder="＊＊區＊＊路＊＊巷＊＊號＊＊樓"  value="<?= htmlentities($row['address']) ?>">
                    </div>

                    <div class=" text-center mt-4"><button type="submit" class="custom-btn btn-4 t_shadow">修改</button></div>


                </form>
            </div>


        </div>
    </div>

</div>
<?php include __DIR__ . '/parts/scripts.php'; ?>
<script src="erTWZipcode-master/js/er.twzipcode.data.js"></script>
<script src="erTWZipcode-master/js/er.twzipcode.min.js"></script>
<script>
    const email_re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    const $name = $('#name'),
        $email = $('#email_2nd'),
        $mobile = $('#mobile');

    const fileds = [$name, $email, $mobile];
    const smalls = [$name.next(), $email.next(), $mobile.next()];

    function checkForm() {
        // 回復原來的狀態
        fileds.forEach(el => {
            el.css('border', '1px solid #CCCCCC');
            el.next().text('');
        });

        let isPass = true;

        if (!email_re.test($email.val()) && $email.val() !== "") {
            isPass = false;
            $email.css('border', '1px solid red');
            $email.next().text('請輸入正確的 email');
        }


        if (isPass) {
            $.post(
                'memberEditor-api.php',
                $(document.form1).serialize(),
                function(data) {
                    if (data.success) {
                        modal_init();
                        insertPage("#modal_img", "animation_login.html");
                        insertText("#modal_content", '資料修改成功');
                        $("#modal_alert").modal("show");
                        setTimeout(function(){window.history.back();}, 2000);
                    } else {
                        alert(data.error);
                    }
                },
                'json'
            ).fail(function(e){
                console.log(e);
            })
        }

    }
</script>
<script>
// 設定birthday日期max為今日
var d = new Date();
var max = d.toISOString().split("T")[0];
$("#birthday").attr("max", max);
</script>
<script>
  erTWZipcode({
    defaultCountyText: "請選擇",
    defaultDistrictText: "請選擇"
  });
  var distEl = document.querySelector('#myForm select[name=district]');
  document.querySelector('#myForm select[name=county]')
    .addEventListener("change", function(evt){
      //refresh district element
    //   M.FormSelect.init(distEl);
    });
  //first time init all select elements in #myForm
//   M.FormSelect.init(document.querySelectorAll('#myForm select'));
  document.querySelector('#myForm select[name=county]').value = "<?= $_SESSION['staff']['county'] ?>";
  document.querySelector('#myForm select[name=district]').value = "<?= $_SESSION['staff']['district'] ?>";
</script>
<?php include __DIR__ . '/parts/html-foot.php'; ?>