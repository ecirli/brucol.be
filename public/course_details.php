<?php 
include 'header.php';



// Database connection
$host = 'localhost';
$db   = 'brucol1';
$user = 'scholar';
$pass = 'Bismillahi_25?';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Get course ID from URL
if (!isset($_GET['id'])) {
    die('No course ID provided.');
}
$id = (int)$_GET['id'];

// Fetch course details
$stmt = $pdo->prepare("SELECT * FROM courses WHERE id = ?");
$stmt->execute([$id]);
$c_dtl = $stmt->fetch();

if (!$c_dtl) {
    die('Course not found.');
}
?>

<!-- Add this style block right after header inclusion -->
<!-- Add this to your existing style block -->
<style>
    .course-description p {
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.4 !important;
    }
    .course-description br {
        display: none !important;
    }
    .course-description {
        white-space: pre-line !important;
    }
    .course-overview h2 {
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.4 !important;
    }
    .course-overview p {
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1.4 !important;
        white-space: pre-line !important;
    }
</style>

<!-- start page title -->
<section class="ipad-top-space-margin bg-dark-gray cover-background page-title-big-typography" style="background-image: url('https://via.placeholder.com/1920x540')">
    <div class="background-position-center-top h-100 w-100 position-absolute left-0px top-0" style="background-image: url('images/vertical-line-bg-small.svg')"></div>
    <div id="particles-style-01" class="h-100 position-absolute left-0px top-0 w-100" data-particle="true" data-particle-options='{"particles":{"number":{"value":8,"density":{"enable":true,"value_area":2000}},"color":{"value":["#d5d52b"]},"shape":{"type":"circle"},"opacity":{"value":1},"size":{"value":8},"move":{"enable":true,"speed":1,"direction":"right"}},"interactivity":{"events":{"onhover":{"enable":false},"onclick":{"enable":false}}},"retina_detect":false}'></div>
    <div class="container">
        <div class="row align-items-center extra-small-screen">
            <div class="col-xl-6 col-lg-7 col-md-8 col-sm-9 position-relative page-title-extra-small" data-anime='{ "el": "childs", "translateY": [-15, 0], "perspective": [1200,1200], "scale": [1.1, 1], "rotateX": [50, 0], "opacity": [0,1], "duration": 800, "delay": 200, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <h1 class="mb-20px alt-font text-yellow"><?= html_entity_decode($c_dtl->c_name) ?></h1>
                <h2 class="fw-500 m-0 ls-minus-2px text-white alt-font">
                    <?= html_entity_decode($c_dtl->description) ?>
                </h2>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->

<!-- course details section  -->
<section class="position-relative py-5">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Course Description -->
            <div class="col-12">
                <div class="course-overview">
                    <h3 class="alt-font text-dark-gray fw-600 mb-4"><?= html_entity_decode($c_dtl->c_name) ?></h3>
                    <p><?= preg_replace('/\s*<br\s*\/?>\s*/', "\n", html_entity_decode($c_dtl->description)) ?></p>
                </div>
                <div class="course-description mt-4">
                    <h3 class="alt-font text-dark-gray fw-600 mb-4"></h3>
                    <p><?= preg_replace('/\s*<br\s*\/?>\s*/', "\n", html_entity_decode($c_dtl->details)) ?></p>
                </div>
            </div>
            
            <!-- Course Image (moved to bottom) -->
            <!-- <div class="col-12 mt-5">
                <div class="shadow-lg rounded overflow-hidden">
                    <img src="/<?= htmlspecialchars($c_dtl->image) ?>" class="img-fluid" alt="<?= htmlspecialchars($c_dtl->c_name) ?>">
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- end course details section -->


<?php
include 'footer.php';
?>