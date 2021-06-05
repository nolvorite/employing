<?php
include('includes/dbconnection.php');
$type=$_GET['type'];
switch($type) {
  case "student":
    $id = $_POST['id'];
    student_delete($id);
    break;
  case "emp":
  	$id = $_POST['id'];
    emp_delete($id);
    break;
  case "job":
  	$id = $_POST['id'];
    job_delete($id);
    break;
  case "category":
  	$id = $_POST['id'];
    category_delete($id);
    break;
  case "industry":
  	$id = $_POST['id'];
    industry_delete($id);
    break;
  case "skill":
  	$id = $_POST['id'];
    skill_delete($id);
    break;
  case "type":
  	$id = $_POST['id'];
    jobtype_delete($id);
    break;
}
function student_delete($id) {
	global $dbh;
	$sql="DELETE FROM tbljobseekers where id=:delid";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':delid', $id, PDO::PARAM_STR);
	$query->execute();
	echo "success";
}
function emp_delete($id) {
	global $dbh;
	$sql="DELETE FROM tblemployers where id=:delid";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':delid', $id, PDO::PARAM_STR);
	$query->execute();
	echo "success";
}
function job_delete($id) {
	global $dbh;
	$sql="DELETE FROM tbljobs where jobId=:delid";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':delid', $id, PDO::PARAM_STR);
	$query->execute();
	echo "success";
}
function category_delete($id) {
	global $dbh;
	$sql="DELETE FROM tblcategory where id=:delid";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':delid', $id, PDO::PARAM_STR);
	$query->execute();
	echo "success";
}
function industry_delete($id) {
	global $dbh;
	$sql="DELETE FROM tblindustries where ind_id=:delid";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':delid', $id, PDO::PARAM_STR);
	$query->execute();
	echo "success";
}
function jobtype_delete($id) {
	global $dbh;
	$sql="DELETE FROM tbljobtype where jo_id=:delid";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':delid', $id, PDO::PARAM_STR);
	$query->execute();
	echo "success";
}
function skill_delete($id) {
	global $dbh;
	$sql="DELETE FROM tblskill where skill_id=:delid";
	$query = $dbh -> prepare($sql);
	$query->bindParam(':delid', $id, PDO::PARAM_STR);
	$query->execute();
	echo "success";
}
