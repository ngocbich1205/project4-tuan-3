<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chọn Web</title>
</head>

<body>
    <style>
        div{
            margin-top: 100px;
            margin-left: 40%;
        }
        button {
            height: 50px;
            margin-right: 50px;
            padding: 40px;
            padding-top: 30px;
            cursor: pointer;
        }

        .btn1 {
            background-color: orangered;
            border: 0;
            border-radius: 5px;
            color: #fff;
            opacity: 0.8;
            float: left;
        }

        .btn2 {
            background-color: cornflowerblue;
            border: 0;
            border-radius: 5px;
            color: #fff;
            opacity: 0.8;
        }

        button:hover {
            opacity: 1;
            transform: translateY(-10px);
            transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
        }
        @media screen and (max-width:768px) {
            div{
                margin-left: 5%;
            }
            button{
                margin-right: 10px;
            }
            .btn1{
                margin-right: 20px;
            }
        }
    </style>
    <div>
        <a href="Homepage"><button class="btn1" onclick="web1()"><b>Web Cũ</b></button></a>
        <a href="web__an_new"><button class="btn2" onclick="web1()"> <b>Web Đã UPDATE</b> </button></a>
    </div>
        
</body>

</html>