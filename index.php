<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './project2/header.inc' ?> 
    <meta name="author" content="LastMinuteHeroesG02 - Tonoy">
    <link rel="stylesheet" href="./project2/styles/styles.css" type="text/css">
    <title>Home</title> 
</head>

<body>
    <?php include "./project2/nav.inc"?>
    <main class="main_page_layout top_margin_PC top_margin_mobile">
    <article class="left_portion">
        <section class="section1">

            <div class="text_content">
                <h2>Last Minute Heroes</h2>
                <h3>Your trusted IT saviors, solving digital emergencies — just in time!</h3>
                <br>
                <p>
                    At Last Minute Heroes, we specialize in providing top-tier IT solutions under pressure. Whether it's network outages, cybersecurity threats, or urgent system upgrades, our team of tech experts steps in when time is running out. We're committed to excellence, innovation, and getting the job done right — even at the eleventh hour.
                </p>
                
            </div>
            <div class="image"></div>
            <!-- AdobeStock_1284169178 This image has been downloaded from Adobe stock -->
        </section> 
        <section class="section2 section1">
            <div class="text_content">
                <h2>Growing with You</h2>
                <h3>Expanding our team to serve you better</h3>
                <br>
                <p>
                    At Last Minute Heroes, we believe in staying ahead of the curve. As we continue to grow and support an ever-increasing number of clients, our team is expanding too! 
                    We're on the lookout for skilled and passionate Network Administrators who are ready to tackle real-world IT challenges and keep digital infrastructures running smoothly.
                </p>
                <br>
                <p>
                    If you're driven by problem-solving and have a strong background in networking, security, and system management — we want to hear from you. Join a team that's fast, reliable, and always ready to be the hero in someone's IT emergency.
                </p>
                <p>
                    📩 Apply now and be a part of our journey to make tech support faster, smarter, and more dependable than ever before.
                </p>
            </div>
            <div class="image"></div>
        </section>
        <section>
        <?php
            // functions
            require_once("project2/functions/storelogin.php");
            //require_once("project2/functions/MyFriendsSystemQuery.php");

            // check dir exists
            if (!is_file("project2/functions/mykeys.inc.php")) {
                // define default database access details
                $host = "localhost";
                $user = "root";
                $pswd = "";
                $dbnm = "Last_Minute_Heroes_db";
                $dir = "project2/functions";
                $file = "project2/functions/mykeys.inc.php";
                $umask = "0000";
                // save database access details to dir/file
                storeLogin($host, $user, $pswd, $dbnm, $dir, $file, $umask);
                echo("<p>Success: Database access details stored in 'project2/functions/mykeys.inc.php'.</p>");
            } else {
                // database access details
                require_once("project2/functions/mykeys.inc.php");
            }
            
            // begin setup
            echo("<p>Action: Begin Database Setup.</p>");


            // TONOY : @RORY I'm not getting this part :) 

            // MyFriendsSystemQuery.php is an object with mysqli capabilities which can createTables() and populateTables() with data
            // populates relation 'friends' and 'myfriends' with 10 friends
            //$populate = new MyFriendsSystemQuery($host, $user, $pswd, $dbnm);
            // populate tables 'friends' and 'myfriends'
            //$populate->create_tables();
            // populate tables 'friends' and 'myfriends'
            //$populate->populate_tables();
           // echo("<p>Success: Tables 'friends' and 'myfriends' populated.</p>");
        ?>
        </section>
    </article>
    <aside id="aside_home">
        <h4>✨ Did You Know?</h4>
        <p>
        Last Minute Heroes started as a small team of uni students with a passion for fixing problems — fast. Today, we’ve grown into a full-service IT company helping businesses across Australia stay online, secure, and ahead of the curve.
        </p>
        <p>
        We believe that with the right mix of skills, teamwork, and a touch of adrenaline, no challenge is too big — or too late — to solve.
        </p>
    </aside>
    </main>


    <?php include './project2/footer.inc'?>
</body>
</html>