<?php
session_start();

// Check if the user is logged in

?>


<?php
include('db.php');



// Query to fetch Indian Entertainment channels
$query1 = "SELECT * FROM `tv channels` WHERE `ccategory` = 'SPORTS'";
$result1 = mysqli_query($conn, $query1);

// Query to fetch Kids channels
$query2 = "SELECT * FROM `tv channels` WHERE `ccategory` = 'Pak Entertainment Channels'";
$result2 = mysqli_query($conn, $query2);

// Query to fetch SPORTS channels
$query3 = "SELECT * FROM `tv channels` WHERE `ccategory` = 'Indian Entertainment'";
$result3 = mysqli_query($conn, $query3);

// Query to fetch Indian News Channels
$query4 = "SELECT * FROM `tv channels` WHERE `ccategory` = 'Indian News Channels'";
$result4 = mysqli_query($conn, $query4);

// Query to fetch Pak Entertainment Channels
$query5 = "SELECT * FROM `tv channels` WHERE `ccategory` = 'Kids channels'";
$result5 = mysqli_query($conn, $query5);

// Query to fetch Pak religious channels
$query6 = "SELECT * FROM `tv channels` WHERE `ccategory` = 'Pak religious channels'";
$result6 = mysqli_query($conn, $query6);

// Query to fetch Pak News channels
$query7 = "SELECT * FROM `tv channels` WHERE `ccategory` = 'Pak News channels'";
$result7 = mysqli_query($conn, $query7);

// Query to fetch All channels
$query8 = "SELECT * FROM `tv channels`";
$result8 = mysqli_query($conn, $query8);



?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com -->
<html lang="en">

<head>
    <title>ITWeb | Live TV</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!----======== CSS ======== -->
  <link rel="stylesheet" href="sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.1.2/css/swiper.min.css">
    <link rel="stylesheet" href="styles.css">
  
  <!----===== Boxicons CSS ===== -->
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<style type="text/css">
  .neomorphic-search {
    width: 80%;
    padding: 20px 20px;
    font-size: 16px;
    border-radius: 20px;
    background: #e0e0e0; /* Light background */
    box-shadow: 
        5px 5px 10px #bebebe, /* Darker shadow */
        -5px -5px 10px #ffffff; /* Lighter shadow */
    border: none;
    outline: none;
    transition: box-shadow 0.3s ease;
    justify-content:center;
}

.neomorphic-search:focus {
    box-shadow: 
        inset 5px 5px 10px #bebebe, /* Inset darker shadow */
        inset -5px -5px 10px #ffffff; /* Inset lighter shadow */
}

.neomorphic-search::placeholder {
    color: #a0a0a0; /* Placeholder text color */
}

.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

  

.toolbar {
            display: flex;
                
            justify-content: space-between;
            align-items: center;
            background-color: #0084CA; /* Toolbar background color */
            padding: 10px;
        }

        .app-title {
            color: white;
            font-size: 20px;
            font-weight: bold;
        }

        .search-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-icon {
            background-color: ; /* Background color for the search icon area */
            padding: 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: white;
            font-family: 'FontAwesome';
            font-size: 18px;
        }

        .search-input {
            position: absolute;
            right: 0;
            height: 36px;
            border: none;
            outline: none;
            padding: 5px;
            border-radius: 5px;
            display: none; /* Initially hide the input field */
        }

        .search-container:hover .search-input {
            display: block; /* Show the input field on hover */
            width: 200px; /* Adjust width as needed */
        }

        .search-container:hover .search-icon {
            background-color: #0084CA; /* Change color on hover */
        }

  /* Modal styles */

    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        overflow: hidden;
    }

    /* Animation keyframes */
    @keyframes modalOpen {
        from {
            opacity: 0;
            transform: scale(0.7);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes modalClose {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.7);
        }
    }

    .modal-content {
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent modal content */
        margin: -10px 0px 10px 10px;
        padding: 0px;
        border: 1px solid #888;
        width: 80%;
        height: 90%;
        max-width: 800px;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        animation: modalOpen 0.5s ease-out;
    }

    .close1 {
        shape-outside: content-box;
        color: black;
        display: flex;
        float: right;
        font-size: 27px;
        font-weight: 600;
        height: 29px;
        width: 28px;
        text-align: center;
        border: 0px solid white;
        border-radius: 19%;
        flex-wrap: wrap;
        justify-content: center;
        flex-direction: column;
        align-items: stretch;
    }

    .close1:hover,
    .close1:focus {
        color: white;
        text-decoration: none;
        cursor: pointer;
        background-color: red;
    }

    /* Modal open and close classes */
    .modal.show {
        display: block;
        animation: modalOpen 0.5s ease-out;
    }

    .modal.hide {
        animation: modalClose 0.9s ease-in;
        display: none;
    }
</style>
  <!--<title>Dashboard Sidebar Menu</title>-->
</head>

<body>
  <nav class="sidebar close">
    <header>
 <a class="text close1" id="closeside" style="font-size:27px;">&times;</a>
      <div class="image-text" style="
    align-content: center;
    padding-left: 40px;
">
  <script>  var closeside1 = document.getElementById("closeside");
closeside1.addEventListener("click", () => {
      sidebar.classList.add("close");
});

         
</script>
        <div class="card" padding-left="0px">
                <img alt="ITWeb | The Tech Hub" height="9px; " id="User avatar" src="icon/user.png" style="display: block; border-radius:50%" width="130px; "><h3>Welcome, <?php echo isset($_SESSION['firstname']) ? htmlspecialchars($_SESSION['firstname']) : 'Guest'; ?>!</h3></h3></div>

  
    </header>

    <div class="menu-bar">
      <div class="menu">

       <!-- <li class="search-box">
    <i class='bx bx-search icon'></i>
    <input type="text" id="searchInput" placeholder="Search channels..." onkeyup="searchChannels()">
</li>-->

        <ul class="menu-links">
          <li class="nav-link">
            <a href="#">
              <i class='bx bx-home-alt icon'></i>
              <span class="text nav-text">HOME</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-bar-chart-alt-2 icon'></i>
              <span class="text nav-text">Trends</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-bell icon'></i>
              <span class="text nav-text">Alerts</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-pie-chart-alt icon'></i>
              <span class="text nav-text">Analytics</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-heart icon'></i>
              <span class="text nav-text">Favourites</span>
            </a>
          </li>

          <li class="nav-link">
            <a href="#">
              <i class='bx bx-wallet icon'></i>
              <span class="text nav-text">Support Us</span>
            </a>
          </li>

        </ul>
      </div>

      <div class="bottom-content">
       <li class="">
            <a href="<?php echo isset($_SESSION['userid']) ? 'logout.php' : 'form.html'; ?>">
                <i class='bx <?php echo isset($_SESSION['userid']) ? 'bx-log-out' : 'bx-log-in'; ?> icon'></i>
                <span class="text nav-text">
                    <?php echo isset($_SESSION['userid']) ? 'Logout' : 'Login'; ?>
                </span>
            </a>
        </li>

        <li class="mode">
          <div class="sun-moon">
            <i class='bx bx-moon icon moon'></i>
            <i class='bx bx-sun icon sun'></i>
          </div>
          <span class="mode-text text">Dark mode</span>

          <div class="toggle-switch">
            <span class="switch"></span>
          </div>
        </li>
      </div><br>
<footer style="background-color: white;padding-top: 0px;text-align: center;font-size: 14px;">
    <p>© 2024. ITWeb TV. All rights reserved.</p>
    <p>Designed &amp; Developed by <a href="facebook,com/sagarali11">Sagar Ali</a>.</p>
</footer>
    </div>

  </nav>

   <style>
  
</style>

<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <a class="close1" id="close">&times;</a>
        <iframe id="playerFrame" width="100%" height="500px" frameborder="0"></iframe>
    </div>
</div>


<section style="padding-left:80px">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Toolbar</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        
    </style>
</head>
<body>
    <div class="toolbar">
	 <b class='toggle'> &#9776; </b>
        <div class="app-title">ITWeb TV</div>
        <div class="search-container">
            <div class="search-icon">&#xf002;</div> <!-- Search icon using FontAwesome -->
            <input type="text" class="search-input" id="searchInput" placeholder="Search channels..." onkeyup="searchChannels()">
        </div>
    </div>
</body>
</html>


    <div class="swiper-container swiper-container-horizontal">

        <!-- Add Pagination -->
        <div class="swiper-pagination swiper-pagination-clickable" style="margin-top:61px">
            <span class="swiper-pagination-bullet swiper-pagination-bullet-active">Tab 1</span>
            <span class="swiper-pagination-bullet">Tab 2</span>
            <span class="swiper-pagination-bullet">Tab 3</span>
            <span class="swiper-pagination-bullet">Tab 4</span>
            <span class="swiper-pagination-bullet">Tab 5</span>
        </div>

 <div id="searchResults" style="display:block"></div>

        <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-854px, 0px, 0px); padding-top: 61px; padding-left: 1px;margin-right:-20px;">
           
 <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0">
                <div class="">

				
                    <h2 class="line" style="font-size: 22px;padding-top: 20px;"> SPORTS CHANNELS</h2>
                   

                   
                    
                    
                    
                    <body translate="no">

    <?php while($row1 = mysqli_fetch_assoc($result1)): ?>
    <div class="column">
        <div class="card">
            <a href="javascript:void(0);" onclick="redirectToPlayer('<?php echo $row1['CURL']; ?>');">
                <img alt="<?php echo $row1['CNAME']; ?>" src="<?php echo $row1['CLOGO']; ?>" onerror="this.onerror=null;this.src='https://s3-us-west-2.amazonaws.com/anchor-generated-image-bank/staging/podcast_uploaded_nologo400/38909171/38909171-1709664849186-7c033f87c89c2.jpg';"/>
                <?php echo $row1['CNAME']; ?>
            </a>
        </div>
    </div>
    <?php endwhile; ?>
    </div></div>

<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="1" > 
 <div class="row"><h2 class="line" style="font-size: 22px;padding-top: 20px;"> PAK ENTERTAINMENT CHANNELS</h2>
        <?php while($row1 = mysqli_fetch_assoc($result2)): ?>
         <div class="column">
        <div class="card">
            <a href="javascript:void(0);" onclick="redirectToPlayer('<?php echo $row1['CURL']; ?>');">
                <img alt="<?php echo $row1['CNAME']; ?>" src="<?php echo $row1['CLOGO']; ?>" onerror="this.onerror=null;this.src='https://s3-us-west-2.amazonaws.com/anchor-generated-image-bank/staging/podcast_uploaded_nologo400/38909171/38909171-1709664849186-7c033f87c89c2.jpg';"/>
                <?php echo $row1['CNAME']; ?>
            </a>
        </div>
    </div>
        <?php endwhile; ?>
        
        
    </div><div class="row"><h2 class="line" style="font-size: 22px;padding-top: 20px;"> PAK NEWS CHANNLES</h2>
        <?php while($row1 = mysqli_fetch_assoc($result7)): ?>
         <div class="column">
        <div class="card">
            <a href="javascript:void(0);" onclick="redirectToPlayer('<?php echo $row1['CURL']; ?>');">
                <img alt="<?php echo $row1['CNAME']; ?>" src="<?php echo $row1['CLOGO']; ?>" onerror="this.onerror=null;this.src='https://s3-us-west-2.amazonaws.com/anchor-generated-image-bank/staging/podcast_uploaded_nologo400/38909171/38909171-1709664849186-7c033f87c89c2.jpg';"/>
                <?php echo $row1['CNAME']; ?>
            </a>
        </div>
    </div>
        <?php endwhile; ?></div>
    </div>


    
<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="2"> 
    <div class="row">
        <h2 class="line" style="font-size: 22px;padding-top: 20px;">INDIAN ENTERTAINMENT CHANNELS</h2>
        <?php while($row1 = mysqli_fetch_assoc($result3)): ?>
        <div class="column">
        <div class="card">
            <a href="javascript:void(0);" onclick="redirectToPlayer('<?php echo $row1['CURL']; ?>');">
                <img alt="<?php echo $row1['CNAME']; ?>" src="<?php echo $row1['CLOGO']; ?>" onerror="this.onerror=null;this.src='https://s3-us-west-2.amazonaws.com/anchor-generated-image-bank/staging/podcast_uploaded_nologo400/38909171/38909171-1709664849186-7c033f87c89c2.jpg';"/>
                <?php echo $row1['CNAME']; ?>
            </a>
        </div>
    </div>
        <?php endwhile; ?>
    </div>
    <br>
    <h2 class="line" style="font-size: 22px;padding-top: 20px;">INDIAN NEWS CHANNELS</h2>
    <div class="row">
        <?php while($row1 = mysqli_fetch_assoc($result4)): ?>
        <div class="column">
        <div class="card">
            <a href="javascript:void(0);" onclick="redirectToPlayer('<?php echo $row1['CURL']; ?>');">
                <img alt="<?php echo $row1['CNAME']; ?>" src="<?php echo $row1['CLOGO']; ?>" onerror="this.onerror=null;this.src='https://s3-us-west-2.amazonaws.com/anchor-generated-image-bank/staging/podcast_uploaded_nologo400/38909171/38909171-1709664849186-7c033f87c89c2.jpg';"/>
                <?php echo $row1['CNAME']; ?>
            </a>
        </div>
    </div>
        <?php endwhile; ?>
    </div>
</div>

<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="3" style="width: 854px;">

                    <div class=""> <h2 class="line" style="font-size: 22px;padding-top: 20px;"> KIDS TV Channels</h2>
                        <?php while($row1 = mysqli_fetch_assoc($result5)): ?>
         <div class="column">
        <div class="card">
            <a href="javascript:void(0);" onclick="redirectToPlayer('<?php echo $row1['CURL']; ?>');">
                <img alt="<?php echo $row1['CNAME']; ?>" src="<?php echo $row1['CLOGO']; ?>" onerror="this.onerror=null;this.src='https://s3-us-west-2.amazonaws.com/anchor-generated-image-bank/staging/podcast_uploaded_nologo400/38909171/38909171-1709664849186-7c033f87c89c2.jpg';"/>
                <?php echo $row1['CNAME']; ?>
            </a>
        </div>
    </div>
        <?php endwhile; ?>  </div>
</div>
<div class="swiper-slide swiper-slide-next" data-swiper-slide-index="4" style="width: 854px;">
    <div class=""> <h2 class="line" style="font-size: 22px;padding-top: 20px;"> RELIGIOUS TV Channels</h2>
                         <?php while($row1 = mysqli_fetch_assoc($result6)): ?>
         <div class="column">
        <div class="card">
            <a href="javascript:void(0);" onclick="redirectToPlayer('<?php echo $row1['CURL']; ?>');">
                <img alt="<?php echo $row1['CNAME']; ?>" src="<?php echo $row1['CLOGO']; ?>" onerror="this.onerror=null;this.src='https://s3-us-west-2.amazonaws.com/anchor-generated-image-bank/staging/podcast_uploaded_nologo400/38909171/38909171-1709664849186-7c033f87c89c2.jpg';"/>
                <?php echo $row1['CNAME']; ?>
            </a>
        </div>
    </div>
        <?php endwhile; ?>  </div>
               
            </div>
        
    </div>


  </section>
<script>
                        function getOS() {
                            var userAgent = window.navigator.userAgent,
                                platform = window.navigator?.userAgentData?.platform || window.navigator.platform,
                                macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
                                windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
                                iosPlatforms = ['iPhone', 'iPad', 'iPod'],
                                os = null;

                            if (macosPlatforms.includes(platform)) {
                                os = 'MacOS';
                            } else if (iosPlatforms.includes(platform)) {
                                os = 'iOS';
                            } else if (windowsPlatforms.includes(platform)) {
                                os = 'Windows';
                            } else if (/Android/.test(userAgent)) {
                                os = 'Android';
                            } else if (!os && /Linux/.test(platform)) {
                                os = 'Linux';
                            }

                            return os;
                        }

                        function redirectToPlayer(channel) {
                            var modal = document.getElementById("myModal");
                            var playerFrame = document.getElementById("playerFrame");

                            var os = getOS();
                            if (os === 'Android')  {
                                window.location.href = "intent:" + channel + "?&profile=ITWeb#Intent;package=com.genuine.leone;end";
                            } else {
                                playerFrame.src = "player.php?channel=" + encodeURIComponent(channel);
                                 modal.classList.add("show");
        							modal.classList.remove("hide");
                            }
                        }

                        const modal = document.getElementById("myModal");
    const closeBtn = document.getElementById("close");

    // Function to open the modal
    function openModal() {
        modal.classList.add("show");
        modal.classList.remove("hide");

    }

    // Function to close the modal
    function closeModal() {
        modal.classList.add("hide");
		 modal.classList.remove("show");
			document.getElementById("playerFrame").src = "";
           
    }

    // Add event listener for close button
    closeBtn.addEventListener("click", closeModal);
			
    // Example of opening the modal
     //closeModal(); // Uncomment this line to open the modal automatically on page load

                        // Close the modal when the user clicks anywhere outside of the modal
                        window.onclick = function(event) {
                            var modal = document.getElementById("myModal");
                            if (event.target == modal) {
                                 modal.classList.add("hide");
		 							modal.classList.remove("show");
                                		document.getElementById("playerFrame").src = "";
                            }
                        }

            </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.1.2/js/swiper.min.js"></script>
        <script>
            var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                slidesPerView: 1,
                paginationClickable: true,
                loop: true,
                paginationBulletRender: function (index, className) {
                    var tabsName = ['SPORTS TV', 'PAK TV', 'INDIAN TV', 'KIDS TV' , 'RELIGIOUS'];
                    if (index === tabsName.length - 1) {
                        return '<span class="' + className + '">' + tabsName[index] + '</span>' +
                            '<div class="active-mark"></div>';
                    }
                    return '<span class="' + className + '">' + tabsName[index] + '</span>';
                }
            });

            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('active');
            }
        </script>
  <script>
    const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");
    toggle.addEventListener("click", () => {
      sidebar.classList.toggle("close");
    })
    searchBtn.addEventListener("click", () => {
      sidebar.classList.remove("close");
    })
    modeSwitch.addEventListener("click", () => {
      body.classList.toggle("dark");
      if (body.classList.contains("dark")) {
        modeText.innerText = "Light mode";
      } else {
        modeText.innerText = "Dark mode";
      }
    });
  </script>

<script>
                        function searchChannels() {
                            var input = document.getElementById("searchInput").value;
							var result = document.getElementById("searchResults");
                            if (input.length < 1) {
                                document.getElementById("searchResults").innerHTML = ""; 
                                    result.style.display = 'none';
                              

// Clear results if input is too short
                                return;
                            }

                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "search.php?q=" + input, true);
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    document.getElementById("searchResults").innerHTML = xhr.responseText;
                                }
                            };
                            xhr.send();
                        }
                    </script>

<script>
                        const body = document.querySelector('body'),
                            sidebar = body.querySelector('nav'),
                            toggle = body.querySelector(".toggle"),
                            searchBtn = body.querySelector(".search-box"),
                            modeSwitch = body.querySelector(".toggle-switch"),
                            modeText = body.querySelector(".mode-text");

                        toggle.addEventListener("click", () => {
                            sidebar.classList.toggle("close");
							closeside.style.display='block';

                        });
							


                        searchBtn.addEventListener("click", () => {
                            sidebar.classList.remove("close");
                        });

                        modeSwitch.addEventListener("click", () => {
                            body.classList.toggle("dark");
                            if (body.classList.contains("dark")) {
                                modeText.innerText = "Light mode";
                            } else {
                                modeText.innerText = "Dark mode";
                            }
                        });

                        document.addEventListener("click", (event) => {
                            const isClickInsideSidebar = sidebar.contains(event.target);
                            const isClickInsideToggle = toggle.contains(event.target);

                            if (!isClickInsideSidebar && !isClickInsideToggle) {
                                sidebar.classList.add("close");
                            }
                        });
                    </script>



</body>

</html>