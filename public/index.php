<?php
    require_once("../vendor/autoload.php"); 
    session_start();
    App\User::isLogin($_SESSION["login"], "/app/registration.php");

    $db = new App\DateBase();
    $stmt = $db->conn->prepare("SELECT * FROM `reg_log` WHERE `name` = ? OR `email` = ?");
    $stmt->execute([$_SESSION['login'], $_SESSION['login']]);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Mate | Todo</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <header>
        <div class="container" style="margin: 21px;">
            <nav>
                <ul>
                    <li class="user-cabinet">
                        <a href="../app/user_cabinet.php">
                            <?= $results['name'] ?>
                            <img class="user-cabinet__image" src="<?= $results['avatar'] ?>" alt="Avatar">
                        </a>
                    </li>
                </ul>
            </nav>                                                                                                                                                                                                                
        </div>
    </header>
    <section class="container">
        <div class="mini-container">
            <!-- Add task -->
            <form action="/app/send.php" method="post">
                <input type="text" placeholder="Назва завдання" name="title">
                <input type="text" placeholder="Опис завдання" name="descriptionn">
                <input style="margin-top: 45px" type="submit" value="Добавить" class="button">
            </form>

            <!-- Show tasks list -->
            <div class="tasks scroll-animation">
                <?php
                    $db = new App\DateBase();
                    $stmt = $db->conn->prepare("SELECT * FROM `todo_List` WHERE `completed` = 0");
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                    foreach($results as $result) {
                        ?>
                            <div class="task">
                                <div class="task__info">
                                    <h2 class="task__title"><?= $result['title'] ?></h2>
                                    <h2 class="task__description"><?= $result['description'] ?></h2>
                                </div>
                                <div class="mini_buttons">
                                    <a class="mini-button modal-btn" href="#" data-id="<?= $result['id']; ?>" data-title="<?= $result['title']; ?>" data-description="<?= $result['description']; ?>"><svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"><path d="M13.2366 0.767846C12.9932 0.524412 12.7043 0.331307 12.3863 0.199559C12.0682 0.0678104 11.7274 0 11.3831 0C11.0389 0 10.698 0.0678104 10.38 0.199559C10.062 0.331307 9.77302 0.524412 9.52963 0.767846L1.65763 8.63985C1.28376 9.01396 1.01715 9.48156 0.88563 9.99385L0.0156303 13.3798C-0.00594441 13.4641 -0.00517194 13.5525 0.0178714 13.6364C0.0409148 13.7202 0.0854321 13.7966 0.147028 13.858C0.208623 13.9194 0.285167 13.9637 0.3691 13.9864C0.453033 14.0092 0.541454 14.0097 0.62563 13.9878L4.01063 13.1188C4.52301 12.9876 4.99067 12.7209 5.36463 12.3468L13.2366 4.47485C13.4801 4.23146 13.6732 3.9425 13.8049 3.62447C13.9367 3.30645 14.0045 2.96558 14.0045 2.62135C14.0045 2.27711 13.9367 1.93625 13.8049 1.61822C13.6732 1.30019 13.4801 1.01124 13.2366 0.767846ZM10.2366 1.47485C10.5407 1.17078 10.9531 0.99995 11.3831 0.99995C11.8132 0.99995 12.2256 1.17078 12.5296 1.47485C12.8337 1.77892 13.0045 2.19133 13.0045 2.62135C13.0045 3.05137 12.8337 3.46378 12.5296 3.76785L11.7506 4.54685L9.45763 2.25385L10.2366 1.47485ZM8.75063 2.96085L11.0436 5.25385L4.65763 11.6398C4.41001 11.887 4.10057 12.0631 3.76163 12.1498L1.19463 12.8098L1.85463 10.2428C1.94071 9.90365 2.11693 9.59405 2.36463 9.34685L8.75063 2.96085Z"/></svg></a>
                                    <a class="mini-button mini-button__stroke" href="/app/completed_todo.php?id=<?= $result['id'] ?>"><svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.99772 10L0.112623 4.95166C0.0358915 4.85898 -0.00420379 4.73976 0.000349302 4.61783C0.0049024 4.49589 0.0537685 4.38023 0.137183 4.29394C0.220597 4.20766 0.332415 4.15711 0.450292 4.1524C0.56817 4.14769 0.683424 4.18917 0.773024 4.26854L4.98835 8.62891L13.227 0.116498C13.3166 0.0371265 13.4318 -0.00434844 13.5497 0.00036132C13.6676 0.00507108 13.7794 0.0556186 13.8628 0.141903C13.9462 0.228187 13.9951 0.343853 13.9997 0.465786C14.0042 0.587719 13.9641 0.706939 13.8874 0.799622L4.99772 10Z" fill="black"/></svg></a>
                                </div>
                            </div>
                        <?
                    }
                ?>
            </div>
        </div>
        <h3 class="logo">ListMate</h3>
        <div class="mini-container">
            <!-- Show completed tasks list -->
            <div class="tasks scroll-animation">    
                <?php
                    $db = new App\DateBase();
                    $stmt = $db->conn->prepare("SELECT * FROM `todo_List` WHERE `completed` = 1");
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                    foreach($results as $result) {
                        ?>
                            <div class="task task-completed">
                                <div class="task__info">
                                    <h2 class="task__title task-completed__title"><?= $result['title'] ?></h2>
                                    <h2 class="task__description task-completed__description"><?= $result['description'] ?></h2>
                                </div>
                                <div class="mini_buttons">
                                    <a class="mini-button mini-button__stroke" href="/app/delete_todo.php?id=<?= $result['id'] ?>" style="padding: 17px 17px 12px;"><svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_1_72)"><path d="M14.3239 17.9444H4.67616C4.47306 17.9396 4.27291 17.8949 4.08712 17.8127C3.90133 17.7305 3.73356 17.6126 3.59338 17.4655C3.45321 17.3185 3.34338 17.1453 3.27017 16.9558C3.19696 16.7663 3.1618 16.5642 3.16671 16.3611V5.92694H4.22227V16.3611C4.21723 16.4256 4.22499 16.4905 4.2451 16.5519C4.26522 16.6134 4.29729 16.6703 4.33947 16.7194C4.38165 16.7684 4.43311 16.8086 4.49089 16.8377C4.54867 16.8668 4.61163 16.8842 4.67616 16.8889H14.3239C14.3885 16.8842 14.4514 16.8668 14.5092 16.8377C14.567 16.8086 14.6184 16.7684 14.6606 16.7194C14.7028 16.6703 14.7349 16.6134 14.755 16.5519C14.7751 16.4905 14.7829 16.4256 14.7778 16.3611V5.92694H15.8334V16.3611C15.8383 16.5642 15.8031 16.7663 15.7299 16.9558C15.6567 17.1453 15.5469 17.3185 15.4067 17.4655C15.2665 17.6126 15.0988 17.7305 14.913 17.8127C14.7272 17.8949 14.527 17.9396 14.3239 17.9444Z" fill="black"/><path d="M16.245 4.75001H2.63886C2.49889 4.75001 2.36464 4.69441 2.26567 4.59543C2.16669 4.49645 2.11108 4.36221 2.11108 4.22224C2.11108 4.08226 2.16669 3.94802 2.26567 3.84904C2.36464 3.75006 2.49889 3.69446 2.63886 3.69446H16.245C16.3849 3.69446 16.5192 3.75006 16.6182 3.84904C16.7171 3.94802 16.7728 4.08226 16.7728 4.22224C16.7728 4.36221 16.7171 4.49645 16.6182 4.59543C16.5192 4.69441 16.3849 4.75001 16.245 4.75001Z" fill="black"/><path d="M11.0834 6.86111H12.1389V14.7778H11.0834V6.86111Z" fill="black"/><path d="M6.86108 6.86111H7.91664V14.7778H6.86108V6.86111Z" fill="black"/><path d="M12.1389 3.09276H11.1361V2.1111H7.86386V3.09276H6.86108V2.1111C6.86075 1.84006 6.96468 1.57927 7.15136 1.38276C7.33804 1.18626 7.59316 1.06909 7.86386 1.05554H11.1361C11.4068 1.06909 11.6619 1.18626 11.8486 1.38276C12.0353 1.57927 12.1392 1.84006 12.1389 2.1111V3.09276Z" fill="black"/></g><defs><clipPath id="clip0_1_72"><rect width="19" height="19" fill="white"/></clipPath></defs></svg></a>
                                </div>
                            </div>
                        <?
                    }                    
                ?>
            </div>
        </div>
    </section>
    <footer>
        <h3>Copyright © Tima.com</h3>
    </footer>

    <div class="modal" id="myModal">
            <div class="modal__content">
                <span class="modal__close" id="closeModal">&times;</span>
                <form action="/app/edit_todo.php?id=<? $data['id'] ?>" method="post">
                    <input type="text" placeholder="Назва завдання" name="title">
                    <input type="text" placeholder="Опис завдання" name="description">
                    <input style="margin-top: 45px" type="submit" value="Редагувати" class="button">
                </form>
            </div>
        </div>

    <script src="../public/js/scripts.js"></script>
</body>
</html>