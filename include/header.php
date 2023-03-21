<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortout icon" type="image/x-icon" href="">-->
    <!---->

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="css/jquery.Wload.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">


    <!--font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <title>Manna </title>

    <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap');

    * {
        font-family: 'Zen Kaku Gothic New', sans-serif;
    }

    .yellow-star {
        color: #FFD700;
    }

    .topbar {
        color: black;
        height: 30px;
        width: 100%;
        padding: 5px;
        background-color: #FFFCC3;


    }

    nav {
        height: auto;
        width: 100%;
        padding: 5px;
        position: relative;

    }

    .searchbar {
        padding: 10px;
        border-right: 10px solid #b4c1f5;


    }

    .shopcart {
        padding: 10px;
        border: 1px solid #6b7878;
        border-radius: 20px;
        width: auto;

    }


    .purple-rain {

        background-color: #FCF4A3;
    }

    .det::-webkit-scrollbar {

        width: 0px;
    }

    @media only screen and (max-width: 767px) {
        .card {
            width: 100%;
        }
    }


    @media (max-width: 767px) {
        .circle {
            width: 100px;
            height: 100px;
        }
    }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Rye&display=swap" rel="stylesheet">
</head>


<link href="chat_system/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">


<a href="#" class="open-chat-widget"><i class="fa-solid fa-comment-dots fa-lg"></i></a>
<div class="chat-widget">
    <div class="chat-widget-header">
        <h6 class="title" style='padding: 2px 16px;'>Customer Service</h6>
        <a href="#" class="previous-chat-tab-btn">&lsaquo;</a>
        <a href="#" class="close-chat-widget-btn">&times;</a>
    </div>
    <div class="chat-widget-content">
        <div class="chat-widget-tabs">
            <div class="chat-widget-tab chat-widget-login-tab">
                <form action="chat_system/authenticate.php" method="post">
                    <input type="text" name="name" placeholder="Your Name">
                    <input type="email" name="email" placeholder="Your Email" required>
                    <div class="msg"></div>
                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="chat-widget-tab chat-widget-conversations-tab"></div>
            <div class="chat-widget-tab chat-widget-conversation-tab"></div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>