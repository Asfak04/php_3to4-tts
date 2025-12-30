<?php require_once "web/header.php"; ?>

<form name="frmAdd" method="post" action="" id="frmAdd"
    onSubmit="return validate();">
    <div id="mail-status"></div>
    <div>
        <label style="padding-top: 20px;">Name</label> <span
            id="name-info" class="info"></span><br /> <input type="text"
            name="name" id="name" class="demoInputBox"           
             value="<?php echo $result[0]["name"]; ?>">

    </div>
    <div>
        <label>Email</label> <span id="email-info"
            class="info"></span><br /> <input type="text"
            name="email" id="email" class="demoInputBox"
            value="<?php echo $result[0]["email"]; ?>">
    </div>
    <div>
        <label>Mobile Number</label> <span id="mobile_number_info" class="info"></span><br />
        <input type="text" name="mobile_number" id="mobile_number" class="demoInputBox" value="<?php echo $result[0]["mobile_number"]; ?>">
    </div>
    
    <div>
        <input type="submit" name="add" id="btnSubmit" value="Save" />
    </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
<script>
function validate() {
    var valid = true;   
    $(".demoInputBox").css('background-color','');
    $(".info").html('');
    
    if(!$("#name").val()) {
        $("#name-info").html("(required)");
        $("#name").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#email").val()) {
        $("#email-info").html("(required)");
        $("#email").css('background-color','#FFFFDF');
        valid = false;
    }
    if(!$("#mobile_number").val()) {
        $("#mobile_number_info").html("(required)");
        $("#mobile_number").css('background-color','#FFFFDF');
        valid = false;
    } 
    return valid;
}
</script>
</body>
</html>