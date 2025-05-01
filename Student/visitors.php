<?php
session_start();
// $sic = "23mmci85";
if (isset($_SESSION['sic'])) {
    $current_file = basename(__FILE__);
    include "student_navbar.html";
    // require_once "../Database/student_db_function.php";
    // include "./student_sidebar.php";
    
    ?>
    <div class="d-flex justify-content-center">
        <?php
        include_once "student_sidebar.php";
        ?>
        <div  id="main-content" style="height:90vh;">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-10 mx-auto border-info border pt-2 mt-5 bg-secondary rounded-4" >
                        <h3 class="text-center text-white">Add Visitors</h3>
                        <div class="row ">
                            <div class="col-md-6 my-2">
                                <label class="form-label">Your SIC</label>
                                <input type="text" name="" placeholder="SIC" class="form-control" value="<?php echo $_SESSION['sic']; ?>" readonly>
                            </div>
                            <div class="col-md-6 my-2">
                                <label class="form-label">Your name</label>
                                <input type="text" name="" placeholder="Name" class="form-control" value="<?php echo $_SESSION['name']; ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <label class="form-label">Enter Visitor's Name</label>
                                <input type="text" name="visitor_name" id="visitor-name" placeholder="Visitor's Name" class="form-control">
                                <p class="form-label text-error" id="visitor-name-error"></p>
                            </div>
                            <div class="col-md-6 my-2">
                                <label class="form-label">Relation with visitor</label>
                                <input type="text" name="relation" id="relation" placeholder="Relation" class="form-control">
                                <p class="form-label text-error" id="relation-error"></p>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6 my-2">
                                <label class="form-label">Date of Arrival</label>
                                <input type="date" name="arrival_date" id="date" placeholder="Time" class="form-control">
                                <p class="form-label text-error" id="date-error"></p>
                            </div>
                            <div class="col-md-6 my-2">
                                <label class="form-label">Contact Information</label>
                                <input type="text" name="mobile" id="mobile" placeholder="Mobile number" class="form-control">
                                <p class="form-label text-error" id="mobile-error"></p>
                            </div>
                        </div>
                        <input type="submit" name="add" id="submit" value="Save" class="btn btn-info d-flex mx-auto my-3">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="../Jquery/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function(){
            $("form").submit(function(e){
                // e.preventDefault(); // Prevent the default form submission
                // let stdName = $("#std-name").val();
                let visitorName = $("#visitor-name").val();
                let relation = $("#relation").val();
                let date = $("#date").val();
                let mobile = $("#mobile").val();
                let error = false;

                if(visitorName.length < 3){
                    $("#visitor-name-error").text("Visitor name must be at least 3 characters long");
                    error = true;
                }else{
                    $("#visitor-name-error").text("");
                }

                if(relation.length < 3){
                    $("#relation-error").text("Relation must be at least 3 characters long");
                    error = true;
                }else{
                    $("#relation-error").text("");
                }

                if(date === ""){
                    $("#date-error").text("Please select a date");
                    error = true;
                }else if(date < new Date().toISOString().split("T")[0]){
                    $("#date-error").text("Date cannot be in the past");
                    error = true;
                }else{
                    $("#date-error").text("");
                }

                if(mobile.length != 10){
                    $("#mobile-error").text("Mobile number must be 10 digits long");
                    error = true;
                }else if(isNaN(mobile)){
                    $("#mobile-error").text("Mobile number must be numeric");
                    error = true;
                }else if(!mobile.match(/^[6-9]{1}[0-9]{9}$/)){
                    $("#mobile-error").text("Mobile number must start with 6, 7, 8, or 9");
                    error = true;
                }else{
                    $("#mobile-error").text("");
                }
                if(error){
                    e.preventDefault(); // Prevent the form from submitting if there are errors
                }
                else{
                    console.log(visitorName, relation, date, mobile);
                }
            })
        })
    </script>
    <?php
    if(isset($_POST['add'])){
        require_once "../Database/student_db_function.php";
        $sic = $_SESSION['sic'];
        $name = $_SESSION['name'];
        $visitor_name = $_POST['visitor_name'];
        $relation = $_POST['relation'];
        $arrival_date = $_POST['arrival_date'];
        $mobile = $_POST['mobile'];
        $res = insertVisitorData($sic, $name, $visitor_name,  $relation, $arrival_date, $mobile);
        if($res){
            ?>
            <script>alert("Visitors Added")</script>
            <?php
        }else{
            ?>
            <script>alert("Not added")</script>
            <?php
        }
    }
}
?>