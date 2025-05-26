<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "./header.inc" ?>
    <title>Document</title>
</head>
<body>
    <?php include "./nav.inc" ?>
    <main class=" application_page_layout view_all_applicants top_margin_mobile ">
<article>
    <h2>Filter by Job Job Reference Number</h2>
    <section>
    <h4>Please Enter Job Reference Numbers in this box</h4>
    <form action="?">
    <div class="filter_by_job_reference_number_box">
    <input type="text" id="jrn" name="job_reference_number" placeholder="Enter Job Reference Number">
    <input type="submit" name="filter_by_jrn" value="filter" id="filter_by_jrn">
    </div>
</form>
</section>
</article>
</main>
<?php include "./footer.inc" ?>
</body>
</html>