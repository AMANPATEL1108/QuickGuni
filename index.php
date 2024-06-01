<?php
session_start();
include 'header.php';
?>
<!-- Main Body is here -->
<main class="site-main">
    <div class="site-content-inner">
        <div class="page-headings" style="background-image:url('assets/images/banner.jpg');">
            <div class="container">
                <h2>Home - Our University</h2>
                <ul>
                    <li class="total" style="color: white;">Total Students: <?php echo $studentCount - 1; ?></li>
                    <li class="total" style="color: white;">Total Teachers: <?php echo $teacherCount; ?></li>
                    <li class="total" style="color: white;">Total Events: <?php echo $eventCount; ?></li>
                </ul>
                <div class="breadcrumb-list">
                </div>
            </div>
        </div>
        <div class="page-content-in">
            <br><br>
            <div class="container">
                <p> It shall be the constant endeavour of Our University to meet the educational needs of the youth in
                    the areas of professional studies and provide state-of the art learning opportunities along with
                    inculcation of values of commitment and uprightness. </p>
                <p>Seek, search and offer programs that lead to symbiotic emergence of 'academic excellence' and
                    'industrial relevance' in education and research.</p>
            </div>
        </div>
    </div>
</main>
<!-- Footer is here -->
<?php include 'footer.php'; ?>