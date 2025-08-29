<?php 
include 'header.php';
?>



<?php
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

// Fetch the program
$slug = 'English-Prep-School';
$stmt = $pdo->prepare("SELECT * FROM program WHERE slug = ?");
$stmt->execute([$slug]);
$program = $stmt->fetch();

$courses = [];
if ($program) {
    $stmt2 = $pdo->prepare("SELECT * FROM courses WHERE p_id = ?");
    $stmt2->execute([$program->id]);
    $courses = $stmt2->fetchAll();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($c_dtl->c_name) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
	.header-top {
		/* background:url(../images/banner2.jpg); */

		background: none;
		background-size: 100% 100%;
		background-size: cover;
		/* width: 100%; */
		padding: 0;
		margin: 0;
		background-repeat: no-repeat;
		padding-bottom: 50px;
	}

	.h-top {
		color: white !important;
		font-size: 27px;
		text-transform: uppercase;
	}

	@media (max-width:767px) {
		.h-top {
			margin-top: 50px !important;
		}
	}

	.card button {
		color: #0a70f5;
		text-align: left;
		border-radius: 6px;
	}

	.title1 {
		font-size: 22px;
	}

	.cc a {
		color: #0a70f5;
	}

	.cards {
		border: 1px solid gray;
		width: 320px;
		overflow: hidden;
		/* text-align: center; */
	}

	.cards img {
		width: 180px;
		height: auto;
		margin: auto;

	}

	.cards .prg2 {
		font-size: 20px;
	}

	.title2 {
		color: #0a70f5;
		text-transform: uppercase;

	}

	.cards2 {
		width: 100%;
		display: flex;
		margin-top: 20pxs;
	}
	.card{
		border-radius: 0 !important;
	}
	.description h3,
	.description strong,
	.description b{
       font-size: 18px !important;
	   gap: 20px !important;
	   font-weight: 600 !important;
	   color: #000 !important;
	}
	.description p{
		margin: 10px !important;
	}
	.description ul li{
		list-style: disc;
		white-space: wrap !important;

	}
	.description ul{
		padding: 3px 24px !important;
	}

	.course-fees p{
				position: relative;
				overflow: hidden;
				margin-top: 4px;
			}
			.course-fees{
				display: flex;
				gap: 10px;
			}
			.course-fees, .course-fees *{
				font-size: 16px;
			}
			.course-fees p::after{
           position: absolute;
		   content: "";
		   width: 100%;
		   width: 100px;
		   height: 2px;
		   background: red;
		   background-color: red;
		   bottom: 13px;
		   left: 0;
			}

            .course-box {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    margin-bottom: 30px;
    background: #fff;
    min-height: 340px;
}

.course-img {
    width: 100%;
    height: 220px;
    background-size: cover;
    background-position: center;
    border-radius: 12px 12px 0 0;
}

.over-box {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    padding: 24px 18px 18px 18px;
    background: linear-gradient(0deg,rgba(0,0,0,0.7) 70%,rgba(0,0,0,0.1) 100%);
    color: #fff;
    z-index: 2;
}

.course-head {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #fff;
}

.course-p {
    font-size: 1rem;
    margin-bottom: 12px;
    color: #f1f1f1;
}

.read-more-btn {
    background: #ffd600;
    color: #222;
    border-radius: 20px;
    padding: 6px 18px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s;
}
.read-more-btn:hover {
    background: #ffe066;
    color: #111;
}
</style>

	



 <?php if ($program && $program->slug == 'English-Prep-School'): ?>
    <div class="row w-100">
        <div class="col-12">
            <div class="px-4">
                <h2>Beginner</h2>
                <hr>
            </div>
        </div>
    </div>
    <br>
<?php foreach ($courses as $course): ?>
    <div class="col-lg-6 mt-3">
        <div class="course-box">
            <div class="course-img" style="background-image: url('/<?= htmlspecialchars($course->image) ?>');"></div>
            <div class="over-box">
                <h3 class="course-head"><?= htmlspecialchars($course->c_name) ?></h3>
                <p class="course-p"><?= htmlspecialchars(substr($course->description, 0, 123)) . "..." ?></p>
                <a href="/course_details.php?id=<?= $course->id ?>" class="read-more-btn mt-3">Learn More</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>

<?php
include 'footer.php';
?>