<?php
include('db.php');

if (isset($_GET['q'])) {
    $search = mysqli_real_escape_string($conn, $_GET['q']);
    $query = "SELECT * FROM `tv channels` WHERE `CNAME` LIKE '%$search%'";
    $result = mysqli_query($conn, $query);

echo '<div class="" style="padding-top:62px">';
echo '<h2 class="line">Search Result</h2>';
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="column" style="padding-top:8px; text-align:center">';
            
            echo '<div class="card">';
            echo '<a href="intent:' . $row['CURL'] . '#Intent;package=com.genuine.leone;end">';
            echo '<img alt="' . $row['CNAME'] . '" src="' . $row['CLOGO'] . '" onerror="this.onerror=null;this.src=\'https://s3-us-west-2.amazonaws.com/anchor-generated-image-bank/staging/podcast_uploaded_nologo400/38909171/38909171-1709664849186-7c033f87c89c2.jpg\';"/>';
            echo $row['CNAME'];
            echo '</a>';
            echo '</div>';
            echo '</div>';
			 echo '</div>';
        }
    } else {
        echo '<h2 class="line"> NO RESULT FOUND</h2>';
    }
}
?>
