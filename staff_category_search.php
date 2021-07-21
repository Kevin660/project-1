<?php include __DIR__ . '/parts/config.php'; ?>
<?php
$title = '各項種類資料查詢';
$pageName = 'staff_category_search';

if(
  ! isset($_SESSION['staff'])
){
header('Location: staff_login.php');
exit;
} 


?>
<?php include __DIR__. '/parts/staff_html-head.php'; ?>
<style>
    .container{
        margin: 100px auto;
    }

    select{
        width: 150px;
    }


</style>
<?php include __DIR__. '/parts/staff_navbar.php'; ?>
    <main>
        <div class="container">
            <div id="searchBar"  class="" >
                <h2 class="title b-green rot-135  ">各種類資料查詢</h2>

                <div action="" class="p-2 m-auto  row justify-content-center align-items-center "onsubmit="categorySearch(); return false;">
                    <select id="category" name="">
                        <option disabled hidden selected >各種類查詢</option>
                        <option value="">全部</option>
                        <option value="">森林活動</option>
                        <option value="">森林快報</option>
                        <option value="">客服信件</option>
                    </select>
                    <button type="submit" class="custom-btn btn-4 ml-3 p-0" style="width:3rem; ">送出</button></li>
                </div>
            </div>
                
            <div class=" con_01 my-5  justify-content-center align-items-center">
                <h3  class=" p-2 c_1 m-0 b-green  text-white text-center">森林活動</h3>
                <table id="" class="table table-bordered table-Primary table-hover text-center m-0">
                    <thead class="thead-dark">
                        <tr>
                        <th style="width: 10%;">序號</th>
                            <th>種類名稱</th> 
                            <!-- <th class="m-0 text-white  text-center"><i class="fas fa-trash-alt"></i></th>  -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="bg-dark text-white" style="border: #454d55 1px solid ;">1</td>
                            <td>森林</td>
                            <!-- <td class="m-0  text-white t_shadow text-center"><i class="fas fa-trash-alt"></i></td> -->
                        </tr>
                        <tr>
                            <td class="bg-dark text-white" style="border: #454d55 1px solid ;">2</td>
                            <td>節慶</td>
                            <!-- <td class="m-0  text-white t_shadow text-center"><i class="fas fa-trash-alt"></i></td> -->
                        </tr>
                        <tr>
                            <td class="bg-dark text-white" style="border: #454d55 1px solid ;">3</td>
                            <td>音樂會</td>
                            <!-- <td class="m-0  text-white t_shadow text-center"><i class="fas fa-trash-alt"></i></td> -->

                        </tr>
                        <tr>
                            <td class="bg-dark text-white" style="border: #454d55 1px solid ;">4</td>
                            <td>手工藝</td>
                            <!-- <td class="m-0  text-white t_shadow text-center"><i class="fas fa-trash-alt"></i></td> -->
                        </tr>
                    </tbody>
                </table>
                <div class="row m-0 bg-dark">
                        <a class="col-sm-6 text-center  custom-btn btn-4 t_shadow m-0 text-white"  style="width:100%;border-radius: 0.25rem ;transform: none;"href="staff_category_editor.php" target="_blank">修改</a>

                        <a class="col-sm-6 text-center  custom-btn btn-4 t_shadow m-0 text-white"  style="width:100%;border-radius: 0.25rem ;transform: none;"  href="staff_event_create.php" target="_blank">新增</a>
                </div>

            </div>
            
        </div>
    </main>


<?php include __DIR__. '/parts/staff_scripts.php'; ?>

<script>
  function staffIntoSearch(){
    $.post('<?= WEB_API ?>/staff-api.php', {
        action: 'readAll',
        staff_id: $("#staff_id").val(),
        fullname: $("#fullname").val(),
        mobile: $("#mobile").val(),
        identityNum: $("#identityNum").val(),
        birthmonth: $("#select_month").val(),
        age: $("#age").val(),
    },function(data) {
        console.log(data);
        staff_list = data['result'];
        $("#profile table tbody").html("");
        staff_list.forEach(function(staff, index){
            var output = `<tr>
                            <td class="bg-dark text-white" style="border: #454d55 1px solid ;">${index + 1}</td>
                            <td>${nullTo(staff['staff_id'])}</td>
                            <td>${nullTo(staff['role_name'])}</td>
                            <td>${nullTo(staff['fullname'])}</td>
                            <td>${nullTo(staff['gender'])}</td>
                            <td>${nullTo(staff['birthday'])}</td>
                            <td>${nullTo(staff['identityNum'])}</td>
                            <td>${nullTo(staff['email'])}</td>
                            <td>${nullTo(staff['mobile'])}</td>
                            <td>${nullTo(staff['zipcode']) + nullTo(staff['county']) + nullTo(staff['district']) + nullTo(staff['address'])}</td>
                            <td>${nullTo(staff['created_at'])}</td>

                            </tr>`;
            $("#profile table tbody").append(output);
        })
    }, 'json')
    .fail(
        function(e) {
            alert( "error" );
            console.log(e.responseText);
    });
  }
  function nullTo(str){
    return str === null ? "" : str; 
  }
</script>
<script>
    var month = 1;
    var selectedMonth = "<?= $_GET['month'] ?? "" ?>";
    $("#select_month option").each(function(ind, elem) {
        if (ind > 1) {
            elem.text = month;
            elem.value = month;
            month++;
        }
        if (month > 12) {
            month = 1;
        }
        if (elem.value === selectedMonth){
            elem.selected = true;
        }
    });
</script>

<?php include __DIR__. '/parts/staff_html-foot.php'; ?>
