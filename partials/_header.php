<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            /* Dégradé linéaire multicolore */
            background-color: indianred;
            background-size: 200% 200%;
            font-family: "Toppan Bunkyu Gothic";
        }
        .card-container {
            perspective: 1000px;
            display: inline-block;
            margin: 5px;
        }

        .flip-card {
            width: 200px;
            height: 300px;
            position: relative;
            transform-style: preserve-3d;
            transition: transform 1s;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
        }

        .flip-card-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            transition: transform 1s;
            transform-style: preserve-3d;
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
        }

        .flip-card-back {
            transform: rotateY(180deg);
        }


    </style>
</head>
<body>

</body>
</html>