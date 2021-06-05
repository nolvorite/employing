<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['jpaid']==0)) {
  header('location:logout.php');
  } else{

  ?>
<!doctype html>
<html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <title>Job Portal - Jobseeker Lists</title>

        <link rel="stylesheet" href="assets/js/plugins/datatables/dataTables.bootstrap4.min.css">

        <link rel="stylesheet" id="css-main" href="assets/css/codebase.min.css">

    </head>
    <body>
        
        <div id="page-container" class="sidebar-o sidebar-inverse side-scroll page-header-fixed main-content-narrow">
           
           <?php include_once('includes/sidebar.php');?>

          <?php include_once('includes/header.php');?>


            <!-- Main Container -->
            <main id="main-container">
                <!-- Page Content -->
                <div class="content">
                    <h2 class="content-heading">Jobseeker Lists</h2>

                   

                    <!-- Dynamic Table Full Pagination -->
                    <div class="block">
                        <div class="block-header bg-gd-emerald">
                                    <h3 class="block-title">Jobseeker Lists</h3>
                                  
                                </div>
                        <div class="block-content block-content-full">
                            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality initialized in js/pages/be_tables_datatables.js -->
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                                <thead>
                                    <tr>
                                        <th class="text-center"></th>
                                        <th>Job Title</th>
                                       <th>Job Type</th>
                                       <th>Email</th>
                                        <th>Status</th>
                                        <th class="d-none d-sm-table-cell">Posted Date</th>
                                        <th class="d-none d-sm-table-cell" style="width: 15%;">Action</th>
                                       </tr>
                                </thead>
                                <tbody>
                                    <?php
$sql="SELECT * from tbljobs";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                    <tr id="tr_<?php echo htmlentities ($row->jobId);?>">
                                        <td class="text-center"><?php echo htmlentities($cnt);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->jobTitle);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->jobType);?></td>
                                        <td class="font-w600"><?php  echo htmlentities($row->skillsRequired);?></td>
                                        <?php if($row->IsActive=='1'){ ?>
                                        <td class="font-w600"><?php echo "Active"; ?></td>
                                        <?php } else { ?>

                                            <td class="font-w600"><?php echo "Inactive"; ?></td><?php } ?>

                                        <td class="d-none d-sm-table-cell"><?php  echo htmlentities($row->postinDate);?></td>
                                        
                                         <td class="d-none d-sm-table-cell font-w600"><a href="view-jobseeker-details.php?viewid=<?php echo htmlentities ($row->jobId);?>"><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp;<a onclick="delete_job(<?php echo ($row->jobId);?>)" ><i class="fa fa-trash fa-delete text-danger" aria-hidden="true"></i></a></td>
                                    </tr>
                                    <?php $cnt=$cnt+1;}} ?> 
                                
                                
                                  
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full Pagination -->

                    <!-- END Dynamic Table Simple -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

           <?php include_once('includes/footer.php');?>
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap.min.js"></script>
        <script src="assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="assets/js/core/jquery.appear.min.js"></script>
        <script src="assets/js/core/jquery.countTo.min.js"></script>
        <script src="assets/js/core/js.cookie.min.js"></script>
        <script src="assets/js/codebase.js"></script>

        <!-- Page JS Plugins -->
        <script src="assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page JS Code -->
        <script src="assets/js/pages/be_tables_datatables.js"></script>
        <script>
            function delete_job(a) {
                if(confirm('Do you really want to Delete ?')){
                    $.ajax({
                        url: "delete-service.php?type=job",
                        type: 'post',
                        data: {id: a},
                        success: function(res){
                            if(res==="success") {
                                $("#tr_"+a).hide();
                            }
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    })
                } else return false;
            }
        </script>
    </body>
</html>
<?php }  ?>