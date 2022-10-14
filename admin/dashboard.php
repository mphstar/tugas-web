<?php require('../koneksi.php');
require('../query.php');

session_start();
$pilihroles = ['Admin', 'User'];
if (isset($_COOKIE['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
    $_SESSION['email'] = $_COOKIE['email'];
    $_SESSION['password'] = $_COOKIE['password'];
    $_SESSION['roles'] = $_COOKIE['roles'];
} else {
    session_destroy();
}

if ($_SESSION['roles'] == 'user') {
    header('Location: ../user/dashboard.php');
}

if (!isset($_SESSION['id'])) {
    header('Location: ../login.php?msg=error');
}

$_crud = new crud();
function checkRoles($roles)
{
    switch ($roles) {
        case '1':
            return 'Admin';
            break;
        case '2':
            return 'User';
            break;
        default:
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Dashboard</title>

    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">

    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
    <link rel="stylesheet" href="../assets/extensions/@icon/dripicons/dripicons.css">
    <link rel="stylesheet" href="../assets/css/pages/dripicons.css">

    <link rel="stylesheet" href="../assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/pages/simple-datatables.css">


    <link rel="stylesheet" href="../assets/extensions/sweetalert2/sweetalert2.min.css">

</head>

<body>

    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="../index.php"><img src="../assets/images/logo/logo.svg" alt="Logo" srcset=""></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="dashboard.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu">
                        <li class="sidebar-item ">
                            <a href="multiple_upload.php" name="multiple_upload" class='sidebar-link'>
                                <i class="bi bi-pentagon-fill"></i>
                                <span>Multiple Upload</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu">
                        <li class="sidebar-item ">
                            <a href="vsga.php" name="vsga" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>VSGA</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="menu">
                        <li class="sidebar-item ">
                            <a href="../logout.php" name="logout" class='sidebar-link'>
                                <i class="bi bi-door-closed-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>


                    </ul>
                </div>


            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="row">
                    <div class="col-6">
                        <h3>Dashboard</h3>

                    </div>
                    <div style="text-align: right" class="col-6 mt-3">
                    
                            <p class="breadcrumb-item"><b>Welcome | <?php echo $_SESSION['fullname']; ?></b></p>
                    
                    </div>
                </div>

            </div>
            <div class="page-content">

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col">
                                    <h4>Tabel Data Akun</h4>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table table-hover" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Fullname</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $_crud->execute('SELECT * FROM user_detail');
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($data)) {
                                        $idval = $row['id'];
                                        $emailval = $row['email'];
                                        $fullname = $row['fullname'];
                                        $roles = $row['level'];
                                        $password = $row['password'];
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $emailval; ?></td>
                                            <td><?php echo $fullname; ?></td>
                                            <td><?php echo checkRoles($roles); ?></td>
                                            <td>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletedata<?php echo $idval; ?>">
                                                    Delete
                                                </button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateuser<?php echo $idval; ?>">
                                                    Edit
                                                </button>
                                                <!--update data form Modal -->
                                                <div class="modal fade text-left" id="updateuser<?php echo $idval; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title" id="myModalLabel33">Update Data </h4>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <form action="crudakun.php?id=<?php echo $idval; ?>" method="POST">
                                                                <div class="modal-body">
                                                                    <label>Fullname: </label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="txt_name" placeholder="Email Address" value="<?php echo $fullname; ?>" class="form-control" required>
                                                                    </div>
                                                                    <label>Email: </label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="txt_email" placeholder="Email Address" value="<?php echo $emailval; ?>" class="form-control" required>
                                                                    </div>
                                                                    <label>Roles: </label>
                                                                    <div class="form-group">
                                                                        <select name="txt_roles" class="form-select">
                                                                            <?php
                                                                                for ($i=0; $i < 1; $i++) { 
                                                                                    if(checkRoles($roles)==$pilihroles[$i]){
                                                                                        ?> <option value=<?php echo $roles; ?> selected><?php echo $pilihroles[$i]; ?></option><?php
                                                                                    } else {
                                                                                        ?> <option value=<?php echo $roles; ?>><?php echo $pilihroles[$i]; ?></option><?php
                                                                                    }
                                                                                
                                                                                }
                                                                            ?>
                                                                            <option>User</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Close</span>
                                                                    </button>
                                                                    <button name="edit" type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Update</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>




                                                <!-- hapus data modal -->
                                                <!--Danger theme Modal -->
                                                <div class="modal fade text-left" id="deletedata<?php echo $idval; ?>" tabindex="-1" aria-labelledby="myModalLabel120" style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger">
                                                                <h5 class="modal-title white" id="myModalLabel120">
                                                                    Hapus Data
                                                                </h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <form action="crudakun.php?id=<?php echo $idval; ?>" method="POST">
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin menghapus data <b><?php echo $emailval; ?></b>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Close</span>
                                                                    </button>
                                                                    <button type="submit" name="hapus" class="btn btn-danger ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Yes</span>
                                                                    </button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>


                                </tbody>
                            </table>
                            <div class="modal fade text-left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Tambah Data </h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="crudakun.php" method="POST">
                                            <div class="modal-body">
                                                <label>Fullname: </label>
                                                <div class="form-group">
                                                    <input type="text" name="txt_name" placeholder="Fullname" class="form-control" required>
                                                </div>
                                                <label>Email: </label>
                                                <div class="form-group">
                                                    <input type="text" name="txt_email" placeholder="Email Address" class="form-control" required>
                                                </div>
                                                <label>Password: </label>
                                                <div class="form-group">
                                                    <input type="password" name="txt_password" placeholder="Password" class="form-control" required>
                                                </div>
                                                <label>Roles: </label>
                                                <div class="form-group">
                                                    <select name="txt_roles" class="form-select">
                                                        <option>Admin</option>
                                                        <option>User</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="submit" name="tambah" class="btn btn-primary ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Tambah</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </section>


            </div>


        </div>

    </div>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>

    <!-- Need: Apexcharts -->
    <script src="../assets/js/pages/dashboard.js"></script>
    <script src="../assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="../assets/js/pages/simple-datatables.js"></script>

    <script src="../assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/js/pages/sweetalert2.js"></script>
    <?php
    if (isset($_SESSION['flashLogin'])) {
    ?> <script>
            Swal.fire(
                'Welcome',
                'Selamat datang <?php echo $_SESSION['fullname']; ?>',
                'success'
            )
        </script> <?php
                }
                unset($_SESSION['flashLogin']);
                    ?>

    <?php
    if (isset($_SESSION['flashData'])) {
    ?> <script>
            Swal.fire(
                'Berhasil',
                '<?php echo $_SESSION['flashData'] ?>',
                'success'
            )
        </script> <?php
                }
                unset($_SESSION['flashData']);
                    ?>


</body>


</html>