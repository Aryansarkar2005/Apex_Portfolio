<?php
    $my_name = "Aryan Sarkar";
    $my_university = "C. V. Raman Global University";

    $my_projects = [
        ["title" => "Aurawings", "tech" => "PHP & MySQL", "status" => "Completed"],
        ["title" => "Accident Detection", "tech" => "Python & ML", "status" => "Completed"],
        ["title" => "AI Resume Parser", "tech" => "Python & NLP", "status" => "Completed"],
        ["title" => "Autocorrect AI", "tech" => "Python", "status" => "Completed"],
        ["title" => "New AI Project", "tech" => "Python & LLM", "status" => "In Progress"]
    ];

    $academic_history = [
        ["level" => "B.Tech (AI & Data Science)", "inst" => "C. V. Raman Global University", "status" => "4th Year", "year" => "2027"],
        ["level" => "12th Standard", "inst" => "Higher Secondary School", "status" => "Passed", "year" => "2023"],
        ["level" => "10th Standard", "inst" => "Secondary School", "status" => "Passed", "year" => "2021"]
    ];

    function getStatusBadge($status) {
        $color = ($status == "Completed") ? "#d2b48c" : "#a88e7a";
        return "<span style='color:$color; font-weight:bold;'>$status</span>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aryan Returns!</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-area">
                <h1>Aryan Sarkar | Student</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php#home">HOME</a></li>
                    <li><a href="index.php#projects-section">PROJECTS</a></li>
                    <li><a href="index.php#contact">CONNECT</a></li>
                    <li><a href="admin.php">ADMIN</a></li>
                </ul>
            </nav>
        </div>
    </header>