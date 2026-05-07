<?php
    // Configuration Data
    $my_name = "Aryan Sarkar";
    $my_university = "C. V. Raman Global University";
    $academic_info = [
        "degree" => "B.Tech (AI & Data Science)",
        "status" => "3rd Year Undergraduate",
        "graduation_year" => "2027"
    ];

    // Status Badge Logic
    function getStatusBadge($status) {
        switch ($status) {
            case "Completed":
                return "<span style='color: #4ade80;'>✔ Done</span>";
            case "In Progress":
                return "<span style='color: #fbbf24;'>⏳ Working...</span>";
            default:
                return "<span style='color: #94a3b8;'>📋 Planned</span>";
        }
    }

    $my_projects = [
        [
            "title" => "Aurawings",
            "tech"  => "PHP & MySQL",
            "status" => "Completed"
        ],
        [
            "title" => "Accident Detection",
            "tech"  => "Python & ML",
            "status" => "In Progress"
        ],
        [
            "title" => "New AI Project",
            "tech"  => "Python",
            "status" => "Planned"
        ]
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $my_name; ?> - Portfolio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1><?php echo $my_name; ?> <span class="title-divider">|</span> Student</h1>
            <nav>
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="index.php#projects-section">PROJECTS</a></li>
                    <li><a href="index.php#contact">CONTACT</a></li>
                    <li><a href="admin.php" class="admin-link">ADMIN</a></li>
                </ul>
            </nav>
        </div>
    </header>