<?php
include_once "../../dataLayer/databaseConn.php";
$db =new databaseConn();
if(isset($_POST["feedbackBtn"])){
    $value=$_POST["feedbackText"];
    if($db->insert_data("insert into feedback VALUES ('$value')")){
        $message = "Feedback Provided Successfully";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
?>
<div>
    <button onclick="showForm('ffc')" class="showFeedbackFormBtn">Give Us Feedback</button>
    <div id="ffc" class="feedbackFormContainer">
        <form class="feedbackForm" method="post">
            <textarea rows="10" cols="80" name="feedbackText" maxlength="250" placeholder="Provide Us With Your Feedback" required></textarea>
            <button class="feedbackBtn" name ="feedbackBtn"type="submit">Submit Feedback</button>
        </form>
    </div>
</div>
