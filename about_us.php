<?php include "Nav.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./common.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/aa7454d09f.js" crossorigin="anonymous"></script>

</head>
<body>



<section class="teamSection">
    <h1 class="sectionHeader">Our Strong & Creative Team</h1>
    <div class="carouselContainer">
        <div class="eachCarousel eachTeam">
            <div class="teamPic">
                <img src="./img/team_aung.jpg" class="" alt="">
                <div class="teamSocialLink">
                    <img src="./img/Facebook_black.svg" alt="">
                    <img src="./img/Vimeo_black.svg" alt="">
                    <img src="./img/Twitter_black.svg" alt="">
                    <img src="./img/Instagram_black.svg" alt="">
                </div>
            </div>
            <div class="teamDesc">
                <h1 class="teamName">Mg Aung Myint Tun</h1>
                <p class="position">Backend Developer</p>
            </div>

        </div>

        <div class="eachCarousel eachTeam">
            <div class="teamPic">
                <img src="./img/team_pyaephyo.jpg" alt="">
                <div class="teamSocialLink">
                    <img src="./img/Facebook_black.svg" alt="">
                    <img src="./img/Vimeo_black.svg" alt="">
                    <img src="./img/Twitter_black.svg" alt="">
                    <img src="./img/Instagram_black.svg" alt="">
                </div>
            </div>
            <div class="teamDesc">
                <h1 class="teamName">Mg Pyae Phyoe Aung</h1>
                <p class="position">Frontend Developer</p>
            </div>
        </div>

        <div class="eachCarousel eachTeam">
            <div class="teamPic">
                <img src="./img/team_kyaw.jpg" alt="">
                <div class="teamSocialLink">
                    <img src="./img/Facebook_black.svg" alt="">
                    <img src="./img/Vimeo_black.svg" alt="">
                    <img src="./img/Twitter_black.svg" alt="">
                    <img src="./img/Instagram_black.svg" alt="">
                </div>
            </div>
            <div class="teamDesc">
                <h1 class="teamName">Mg Kyaw Kyaw Naing</h1>
                <p class="position">echo Debugger</p>
            </div>
        </div>

        <div class="eachCarousel eachTeam">
            <div class="teamPic">
                <img src="./img/team_moe.jpg" alt="">
                <div class="teamSocialLink">
                    <img src="./img/Facebook_black.svg" alt="">
                    <img src="./img/Vimeo_black.svg" alt="">
                    <img src="./img/Twitter_black.svg" alt="">
                    <img src="./img/Instagram_black.svg" alt="">
                </div>
            </div>
            <div class="teamDesc">
                <h1 class="teamName">Mg Moe Win</h1>
                <p class="position">UI UX Designer</p>
            </div>

        </div>

        <div class="eachCarousel eachTeam">
            <div class="teamPic">
                <img src="./img/team_paing.jpg" alt="">
                <div class="teamSocialLink">
                    <img src="./img/Facebook_black.svg" alt="">
                    <img src="./img/Vimeo_black.svg" alt="">
                    <img src="./img/Twitter_black.svg" alt="">
                    <img src="./img/Instagram_black.svg" alt="">
                </div>
            </div>
            <div class="teamDesc">
                <h1 class="teamName">Mg Paing Soe</h1>
                <p class="position">Full-Stack Developer</p>
            </div>
        </div>

<!--        <div class="eachCarousel eachTeam">-->
<!--            <div class="teamPic">-->
<!--                <img src="./img/team-image-3.jpg" alt="">-->
<!--                <div class="teamSocialLink">-->
<!--                    <img src="./img/Facebook_black.svg" alt="">-->
<!--                    <img src="./img/Vimeo_black.svg" alt="">-->
<!--                    <img src="./img/Twitter_black.svg" alt="">-->
<!--                    <img src="./img/Instagram_black.svg" alt="">-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="teamDesc">-->
<!--                <h1 class="teamName">Bertha Earley</h1>-->
<!--                <p class="position">Content writer</p>-->
<!--            </div>-->
<!--        </div>-->
    </div>
    <br>
    <div class="carouselIndicator">
        <div class="indicator activeIndicator" onclick="slideCarousel(0)"></div>
        <div class="indicator" onclick="slideCarousel(1)"></div>
        <div class="indicator" onclick="slideCarousel(2)"></div>
        <div class="indicator" onclick="slideCarousel(3)"></div>
        <div class="indicator" onclick="slideCarousel(4)"></div>
<!--        <div class="indicator" onclick="slideCarousel(5)"></div>-->
    </div>
</section>
<br><br>


<?php include "Footer.php"?>
<script src="./script.js"></script>
