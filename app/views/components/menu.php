<div class="top_nav">
    <div class="logo"> Park Location Map</div>
    <div class="nav_items">
    <?php
        // check the user login state
        if(isset($_SESSION['userid'])) {
            echo "<a href='/history/index'>History</a>";
        }
    ?>
    </div>
</div>