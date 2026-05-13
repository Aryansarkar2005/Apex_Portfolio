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
    <title><?php echo isset($page_title) ? $page_title : 'Aryan Returns!'; ?></title>
    
    <?php if(isset($use_bootstrap) && $use_bootstrap): ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <?php endif; ?>

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
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
                    <li><a href="index.php#home"><span class="material-symbols-outlined nav-icon">home</span> HOME</a></li>
                    <li><a href="index.php#projects-section"><span class="material-symbols-outlined nav-icon">work</span> PROJECTS</a></li>
                    <li><a href="index.php#contact"><span class="material-symbols-outlined nav-icon">mail</span> CONNECT</a></li>
                    <li><a href="admin.php"><span class="material-symbols-outlined nav-icon">admin_panel_settings</span> ADMIN</a></li>
                    <li><a href="login.php"><span class="material-symbols-outlined nav-icon">login</span> LOGIN (TASK 2)</a></li>
                </ul>
            </nav>
        </div>
    </header>