<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>AJAX CRUD OPERATION</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2 class="text-primary">AJAX CRUD OPERATION</h2>

    <button class="btn btn-warning" data-toggle="modal" data-target="#myModal">+ ADD</button>
    <br><br>

    <div id="records_contant"></div>

    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button class="close" data-dismiss="modal">&times;</button>
                    <h4>Student Form</h4>
                </div>

                <div class="modal-body">
                    <form id="myform">
                        <label>First Name</label>
                        <input type="text" id="firstname" class="form-control"><br>
                        <label>Last Name</label>
                        <input type="text" id="lastname" class="form-control"><br>
                        <label>Father Name</label>
                        <input type="text" id="fathername" class="form-control"><br>
                        <label>Mother Name</label>
                        <input type="text" id="mothername" class="form-control"><br>
                        <label>Email</label>
                        <input type="email" id="email" class="form-control"><br>
                        <label>Mobile</label>
                        <input type="number" id="mobile" class="form-control"><br>

                        <label>Country</label>
                        <select id="country" class="form-control"><option value="">Select Country</option></select><br>

                        <label>State</label>
                        <select id="state" class="form-control"><option value="">Select State</option></select><br>

                        <label>City</label>
                        <select id="city" class="form-control"><option value="">Select City</option></select><br>

                        <label>College</label>
                        <input type="text" id="college" class="form-control"><br>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" id="savebtn">Save</button>
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){

// Load Table Data
function loadData(){
    $.get("fetch.php", function(data){
        $("#records_contant").html(data);
    });
}
loadData();

// Load Countries
$.get("country.php", function(data){
    $("#country").append(data);
});

// Country - State
$("#country").change(function(){
    // console.log("dfhgh");
    
    let cid = $(this).val();
    // console.log(cid);
    $("#state").html('<option value="">Select State</option>');
    $("#city").html('<option value="">Select City</option>');
    if(cid != ""){
        $.post("state.php",{country_id:cid},function(data){
            $("#state").append(data);
        });
    }
});

// State - City
$("#state").change(function(){
    let sid = $(this).val();
    $("#city").html('<option value="">Select City</option>');
    if(sid != ""){
        $.post("city.php",{state_id:sid},function(data){
            $("#city").append(data);
        });
    }
});

// Save / Update
$("#savebtn").click(function(){
    let id = $(this).attr("data-id");
    let url = id ? "update.php" : "insert.php";

    let fname = $("#firstname").val().trim();
    let lname = $("#lastname").val().trim();
    let father = $("#fathername").val().trim();
    let mother = $("#mothername").val().trim();
    let email = $("#email").val().trim();
    let mobile = $("#mobile").val().trim();
    let college = $("#college").val().trim();
    let country = $("#country").val();
    let state = $("#state").val();
    let city = $("#city").val();

    if(fname=="" || lname=="" || email=="" || country=="" || state=="" || city==""){
        alert("Please fill all mandatory fields");
        return;
    }

    $.post(url,{
        id:id,
        name: fname + " " + lname,
        father_name: father,
        mother_name: mother,
        email: email,
        mobile: mobile,
        college: college,
        country: country,
        state: state,
        city: city
    }, function(res){
        alert(res);
        $("#myform")[0].reset();
        $("#savebtn").text("Save").removeAttr("data-id");
        $("#myModal").modal("hide");
        loadData();
    });
});

// Delete
$(document).on("click",".deleteBtn",function(){
    let id = $(this).data("id");
    if(confirm("Are you sure?")){
        $.post("delete.php",{id:id},function(res){
            alert(res);
            loadData();
        });
    }
});

// Edit
$(document).on("click",".editBtn",function(){
    let id = $(this).data("id");
    $.post("edit_db.php",{id:id},function(data){
        data = JSON.parse(data);

        $("#firstname").val(data.name.split(" ")[0]);
        $("#lastname").val(data.name.split(" ")[1]);
        $("#fathername").val(data.father_name);
        $("#mothername").val(data.mother_name);
        $("#email").val(data.email);
        $("#mobile").val(data.mobile);
        $("#college").val(data.college);

        // Set dropdowns properly
        $("#country").val(data.country_id).change();
        setTimeout(()=>$("#state").val(data.state_id).change(),300);
        setTimeout(()=>$("#city").val(data.city_id),600);

        $("#savebtn").text("Update").attr("data-id",id);
        $("#myModal").modal("show");
    });
});

});
</script>

</body>
</html>
