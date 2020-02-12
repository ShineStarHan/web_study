<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITS 커뮤니티</title>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/admin_copy.css">

</head>

<body>
    <header>
        <?php
        include "header.php";
        ?>
    </header>

    <section>
        <div id="side_navi">
            <ul>
                <h3><b>[ 관리자모드 ]</b></h3>
                <li><a href="admin.php"><span>- 회원관리</span></a></li>
                <li><a href="admin_board.php"><span>- 게시판 관리</span></a></li>
                <li><a href="admin_qna.php"><span>- Q&A 게시판 관리</span></a></li>

            </ul>
        </div>

        <div id="admin_box">

            <h3 id="member_title">
                관리자 모드 > 회원 관리
            </h3>
            <ul id="member_list">
                <li>
                    <span class="col1">번호</span>
                    <span class="col2">아이디</span>
                    <span class="col3">이름</span>
                    <span class="col4">레벨</span>
                    <span class="col5">포인트</span>
                    <span class="col6">가입일</span>
                    <span class="col7">수정</span>
                    <span class="col8">삭제</span>

                </li>
                <?php
                $con = mysqli_connect("localhost", "root", "123456", "test");
                $sql = "select * from mem order by birth";
                $result = mysqli_query($con, $sql);
                $total_record = mysqli_num_rows($result);
                $num = $total_record;

                while ($row = mysqli_fetch_array($result)) {
                    $id = $row["id"];
                    $name = $row["name"];
                    $level = $row["level"];
                    $point = $row["point"];
                    $regist = $row["resist"];
                    $regist  = substr($regist, 0, 10);


                ?>
                    <li>
                        <form action="admin_member_update.php?mode=update" method="post">
                            <span class="col1"><?= $num ?></span>
                            <span class="col2"><?= $id ?></span>
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <span class="col3"><?= $name ?></span>
                            <span class="col4"><input type="text" name="level" value="<?= $level ?>"></span>
                            <span class="col5"><input type="text" name="point" value="<?= $point ?>"></span>
                            <span class="col6"><?= $regist ?></span>
                            <span class="col7"><button type="submit">수정</button></span>
                            <span class="col8"><button type="button" onclick="location.href='admin_member_update.php?mode=delete&id=<?= $id ?>'">삭제</button></span>

                        </form>
                    </li>
                <?php
                    $num--;
                }

                ?>

            </ul>
    
        </div>

    </section>
</body>

</html>