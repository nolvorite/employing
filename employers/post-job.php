<?php
session_start();
//Database Configuration File
include('includes/config.php');
//error_reporting(0);
//verifying Session
if (strlen($_SESSION['emplogin']) == 0) {
  header('location:emp-login.php');
} else {

  //Genrating CSRF Token
  if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }

  if (isset($_POST['submit'])) {

    //Verifying CSRF Token
    if (!empty($_POST['csrftoken'])) {
      if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {

        $empid = $_SESSION['emplogin'];
        //Getting Post Values
        $category = $_POST['category'];
        $jontitle = $_POST['jobtitle'];
        $jobtype = $_POST['jobtype'];
        $salpackg = $_POST['salarypackage'];
        $skills = $_POST['skills'];
        $exprnce = $_POST['experience'];
        $joblocation = $_POST['joblocation'];
        $jobdesc = $_POST['description'];
        $jed = $_POST['jed'];
        $isactive = 1;

        $sql = "INSERT INTO tbljobs(employerId,jobCategory,jobTitle,jobType,salaryPackage,skillsRequired,experience,jobLocation,jobDescription,JobExpdate,isActive) VALUES(:empid,:category,:jontitle,:jobtype,:salpackg,:skills,:exprnce,:joblocation,:jobdesc,:jed,:isactive)";
        $query = $dbh->prepare($sql);
        // Binding Post Values
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':jontitle', $jontitle, PDO::PARAM_STR);
        $query->bindParam(':jobtype', $jobtype, PDO::PARAM_STR);
        $query->bindParam(':salpackg', $salpackg, PDO::PARAM_STR);
        $query->bindParam(':skills', $skills, PDO::PARAM_STR);
        $query->bindParam(':exprnce', $exprnce, PDO::PARAM_STR);
        $query->bindParam(':joblocation', $joblocation, PDO::PARAM_STR);
        $query->bindParam(':jobdesc', $jobdesc, PDO::PARAM_STR);
        $query->bindParam(':jed', $jed, PDO::PARAM_STR);
        $query->bindParam(':isactive', $isactive, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
          $msg = "Your job posted Successfully";
          unset($_SESSION['token']);
        } else {
          $error = "Something went wrong.Please try again";
        }
      }
    }
  }

?>

  <!doctype html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employers | Job Posting</title>
    <link href="../css/custom.css" rel="stylesheet" type="text/css">
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../css/color.css" rel="stylesheet" type="text/css">
    <link href="../css/responsive.css" rel="stylesheet" type="text/css">
    <link href="../css/owl.carousel.css" rel="stylesheet" type="text/css">
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../css/editor.css" type="text/css" rel="stylesheet" />
    <link href="../css/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,300italic,500,700,900' rel='stylesheet' type='text/css'>
    <style type="text/css">
      .filter {
        border: 1px solid #aeaeae;
        height: 45px;
        position: relative;
        cursor: pointer;
        height: auto;
        margin: 0 0 28px 0;
      }

      .filter__name {
        line-height: 45px;
        padding-left: 10px;
        display: block;
        width: 100%;
        height: 100%;
        color: gray;
        overflow: hidden;
        cursor: pointer;
      }

      .filter__name::after {
        color: #042135;
        content: "";
        position: absolute;
        right: 15px;
        top: 16px;
        border: 1px solid black;
        width: 9px;
        height: 9px;
        transform: rotate(45deg);
        border-top: none;
        border-left: none;
        transition: all 0.3s;
      }

      .filter__name p {
        margin: 0;
        display: inline-block;
        padding: 3px 7px;
        background: #43a2ca;
        color: white;
        margin: 0 3px;
        border-radius: 10px;
        line-height: 20px;
      }

      .filter__list {
        width: 100%;
        background: #fff;
        border: 1px solid #ccc;
        padding: 10px 0 10px 0;
        margin: 0;
        display: none;
        position: absolute;
        z-index: 9999;
      }

      .filter__list ul {
        padding: 0;
        margin: 0;
      }

      .filter_active .filter__name::after {
        transform: rotate(-135deg);
        top: 20px;
      }

      .g-cheep {
        border: 1px solid #d7d7d7;
        border-radius: 5px;
        padding: 13px 25px 13px 25px;
        position: relative;
        transition: all 0.2s;
        display: inline-block;
        box-sizing: border-box;
        margin: 7.5px;
      }

      .g-cheep input {
        opacity: 0;
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        margin: 0;
        cursor: pointer;
      }

      .g-cheep input+label {
        position: relative;
        top: 0;
        font-size: 14px;
        line-height: 14px;
        cursor: pointer;
        opacity: 0.6;
      }

      .g-cheep_active {
        background: #43a2ca;
        padding-right: 35px;
        border: none;
      }

      .g-cheep_active>label {
        opacity: 1 !important;
        color: white !important;
      }

      .g-cheep_active::after,
      .g-cheep_active::before {
        position: absolute;
        content: "";
        height: 1px;
        width: 7px;
        background: white;
        right: 15px;
        top: 25px;
      }

      .g-cheep_active::after {
        transform: rotate(45deg);
      }

      .g-cheep_active::before {
        transform: rotate(-45deg);
      }
    </style>


  <body class="theme-style-1">
    <div id="wrapper">
      <!--HEADER START-->
      <?php include('includes/header.php'); ?>
      <!--HEADER END-->


      <!--INNER BANNER START-->
      <section id="inner-banner">

        <div class="container">

          <h1>Employers | Post a Job</h1>

        </div>

      </section>

      <!--INNER BANNER END-->



      <!--MAIN START-->

      <div id="main">
        <!--Signup FORM START-->
        <form name="empsignup" enctype="multipart/form-data" method="post">
          <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />


          <section class="resum-form padd-tb">

            <div class="container">
              <!--Success and error message -->
              <?php if (@$error) { ?><div class="errorWrap">
                  <strong>ERROR</strong> : <?php echo htmlentities($error); ?>
                </div><?php } ?>

              <?php if (@$msg) { ?><div class="succMsg">
                  <strong>Success</strong> : <?php echo htmlentities($msg); ?>
                </div><?php } ?>

              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <label>Category*</label>
                  <div class="selector">
                    <select name='category' class="full-width">
                      <?php
                      $sqlt = "SELECT CategoryName FROM tblcategory order by CategoryName asc";
                      $queryt = $dbh->prepare($sqlt);
                      $queryt->execute();
                      $results = $queryt->fetchAll(PDO::FETCH_OBJ);
                      $cnt = 1;
                      if ($queryt->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                          <option value="<?php echo htmlentities($result->CategoryName); ?>"><?php echo htmlentities($result->CategoryName); ?></option>
                      <?php  }
                      } ?>

                    </select>
                  </div>
                </div>

                <div class="col-md-6 col-sm-6">
                  <label>Job Title*</label>
                  <input type="text" name="jobtitle" required placeholder="e.g. Full Stack Developer" autocomplete="off">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <label>Job Type</label>

                  <div class="selector">

                    <select class="full-width" name="jobtype">
                      <?php
                        $sql = "SELECT * from  tbljobtype";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $industries = $query->fetchAll(PDO::FETCH_OBJ);
                        if ($query->rowCount() > 0) {
                          foreach ($industries as $industry) {
                        ?>
                      <?php
                        echo "<option value='".$industry->jo_name."'>".$industry->jo_name."</option>"
                      ?>
                      <?php
                          }
                        }
                      ?>
                    </select>

                  </div>

                </div>

                <div class="col-md-6 col-sm-6">

                  <label>Salary Package</label>
                  <input type="text" placeholder="e.g. $7000 - 9000" name="salarypackage" required>

                </div>
              </div>


              <div class="row">
                <input type="hidden" name="skills" id="skill_hidden">
                <div class="col-md-6 col-sm-6">
                  <label>Skill Required</label>
                  <!-- <input type="text" placeholder="e.g. PHP, MySQL, HTML, CSS" name="skills" required> -->

                  <div class="filter">
                    <div class="filter__name">
                      Skill
                    </div>
                    <div class="filter__list">
                      <ul>

                      <?php
                        $sql = "SELECT * from  tblskill";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $skills = $query->fetchAll(PDO::FETCH_OBJ);
                        $index=1;
                        if ($query->rowCount() > 0) {
                          foreach ($skills as $skill) {
                        ?>
                      <?php
                        echo "<li class='g-cheep'><input id='g-cheep-".$index."' type='checkbox'><label for='g-cheep-".$index."'>".$skill->skill_name."</label></li>";
                        $index++;
                      ?>
                      <?php
                          }
                        }
                      ?>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-sm-6">
                  <label>Experience</label>
                  <!-- <input type="text" placeholder="e.g. 0-5" name="experience" required> -->
                  <div class="selector">

                    <select class="full-width" name="experience">
                      <option value="1">No experience</option>
                      <option value="2">1~3 yrs experience</option>
                      <option value="3">Above 3 yrs experience</option>
                      
                    </select>

                  </div>
                </div>

              </div>


              <div class="row">

                <div class="col-md-6 col-sm-6">
                  <label>Job Location</label>
                  <input type="text" placeholder="e.g. New Delhi, New York, London" name="joblocation" required>

                </div>
                <div class="col-md-6 col-sm-6">
                  <label>Job Expiration Date</label>
                  <input type="date" placeholder="e.g. 0-5" name="jed" required class="form-control">
                </div>
              </div>


              <div class="row">
                <div class="col-md-12">
                  <h4>Job Description</h4>
                  <div class="text-editor-box">
                    <textarea name="description" required></textarea>
                  </div>
                </div>
              </div>

              <div class="col-md-12">

                <div class="btn-col">

                  <input type="submit" name="submit" value="Submit">

                </div>

              </div>

            </div>



      </div>

      </section>
      </form>
      <!--RESUME FORM END-->

    </div>

    <!--MAIN END-->



    <!--FOOTER START-->

    <?php include('includes/footer.php'); ?>
    <!--FOOTER END-->

    </div>


    <script src="../js/jquery-1.11.3.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- <script src="../js/owl.carousel.min.js"></script> -->
    <!-- <script src="../js/jquery.velocity.min.js"></script> -->
    <!-- <script src="../js/jquery.kenburnsy.js"></script> -->
    <!-- <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script> -->
    <!-- <script src="../js/editor.js"></script> -->
    <!-- <script src="../js/jquery.accordion.js"></script> -->
    <script src="../js/jquery.noconflict.js"></script>
    <script src="../js/theme-scripts.js"></script>
    <script src="../js/jquery-1.11.3.min.js"></script>
    <!-- <script src="../js/custom.js"></script> -->
    <script type="text/javascript">
      var skills=  '';
      $('.filter__name').on('click',function(){
        $(this).siblings('.filter__list').slideToggle(300);
        $(this).closest('.filter').toggleClass('filter_active');
      });

      $('.g-cheep').on('click',function(){
        var $childInput = $(this).find('input');
        if ($childInput.prop('checked')) {
          $(this).addClass('g-cheep_active');
        }
        else {
          $(this).removeClass('g-cheep_active');
        }
      });

      $('.g-cheep').on('click',function () {
        skills=  '';
        var parent = $(this).closest('.filter');
        var inp = $(parent).find('input:checkbox:checked')
          .siblings('label');

        var text = [];

        $(inp).each(function (key, value) {
          textIn = "<p>"+$(value).text()+"</p>" ;
          text.push(textIn);
          if(key+1 == $(inp).length) {
            skills += $(value).text();
          }
          else skills += $(value).text()+", ";
        });
        $('#skill_hidden').val(skills);
        text != 0 ? $(parent).find('.filter__name').html(text) : $(parent).find('.filter__name').text('Filtering') ;
      });
    </script>
  </body>

  </html>
<?php } ?>