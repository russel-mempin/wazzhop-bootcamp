<?php
    $firstName = "Jollibee 1 Pc";
    $lastName = "Macaroni Soup";
    $phoneNumber = "09123456789";
    $email = "jollibeemacaronisoup@gmail.com";
    $role = "Part-time soup";

    $entryPara = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus varius convallis ex nec venenatis. Pellentesque et felis a quam egestas ornare non eu dui. Sed porta odio rutrum nisi ultrices ornare eu nec augue. Nam tempus dolor non nisi vehicula, sit amet mollis ipsum malesuada. Ut vel posuere orci, a mattis elit. Ut dapibus vehicula dolor id pretium. Quisque posuere venenatis ipsum. Aliquam nec massa elit. Mauris vel suscipit enim. Etiam et neque at nibh facilisis facilisis porta at tortor. Integer blandit ac justo quis finibus. Aliquam viverra vitae eros non commodo. Praesent urna velit, auctor ut libero id, ultrices cursus libero. Aenean commodo commodo erat sed lobortis. Interdum et malesuada fames ac ante ipsum primis in faucibus.";
    $linkedIn = "linkedin.com/in/jollibee-macaroni/";

    $skills = array("HTML", "CSS", "JavaScript", "PHP", "MySQL", "C++", "Adobe Photoshop", "Adobe XD", "UI / UX Design");
    $education = array("High School" => "High School Academy", "Senior High School" => "Senior High School University", "College" => "College University");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <script src="https://kit.fontawesome.com/84d068d690.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: Arial;
        }

        .heading {
            padding: 1.5rem 2rem;
            background-color: #171717;
        }

        .heading div {
            margin: 0.5rem 0;
        }

        .heading div:first-of-type {
            color: #D64339;
            display: flex;
        }

        .heading div h2:first-of-type {
            margin-right: 0.5rem;
        }

        .heading div:nth-of-type(2) h4, .heading div:nth-of-type(3) p {
            color: #FFFFFF;
        }

        .heading div:nth-of-type(3) p {
            font-size: 14px;
            text-align: justify;
            text-justify: inter-word;
        }

        .contact {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            background-color: #D64339;
            text-align: center;
            padding: 0.5rem 0;
            color: #FFFFFF;
        }

        .contact i {
            margin-right: 0.5rem;
        }

        .contact p {
            flex-basis: 30%;
        }

        .skills {
            margin: 0.5rem;
        }

        .square {
            width: 40px;
            height: 60px;
            background-color: #D64339;
            margin-right: 0.5rem;
        }

        .skills-heading {
            display: flex;
            align-items: center;
        }

        .skills-heading h4 {
            text-transform: uppercase;
            color: #D64339;
        }

    </style>
</head>
<body>
    <div class="heading">
        <div>
            <h2><?= $firstName ?></h2>
            <h2><?= $lastName ?></h2>
        </div>
        <div>
            <h4><?= $role ?></h4>
        </div>
        <div>
            <p><?= $entryPara ?></p>
        </div>
    </div>
    <div class="contact">
        <p><i class="fa-solid fa-phone"></i><?= $phoneNumber ?></p>
        <p><i class="fa-brands fa-linkedin"></i><?= $linkedIn ?></p>
        <p><i class="fa-solid fa-envelope"></i><?= $email ?></p>
    </div>
    <div class="skills">
        <div class="skills-heading">
            <div class="square">
            </div>
            <h4>Key Skills</h4>
        </div>
        <div class="skills-items">
            
        </div>
    </div>
</body>
</html>