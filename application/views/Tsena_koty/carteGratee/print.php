<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print numero</title>
    <style>
        table {
            border-collapse: collapse;
            width: 700px;
            min-width: 400px;
            text-align: center;
            margin-top: 50px!important;
        }
        
        .table-containt {
            margin-top: 150px!important;

        }
        
        .caption {
            caption-side: bottom;
            font-weight: bold;
            font-style: italic;
        }
        
        table tr:nth-child(odd) td {
            background-color: #F0F0F0;
        }
        
        table,
        th,
        td {
            border: 1px solid gray;
        }
        
        th,
        td {
            height: 24px;
            padding: 4px;
            vertical-align: middle;
        }
        
        th {
            background-image: url(table-shaded.png);
        }
        
        .rowtitle {
            background: #9CF;
            font-weight: bold;
        }
        
        .info {
            display: inline-block;
        }
        
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 27px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        
        .containt {
            width: 700px;
        }
        
        .main {
            margin: auto;
            width: 700px;
            padding: 10px;
            border: solid gray 1px;
            border-radius: 5px;
            /*background: linear-gradient(circle, #1DB1DD, #23D0D2);*/
        }
        
        .info {
            display: inline-block;
            vertical-align: top;
        }
        
        #tire {
            float: right;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="containt">
            <div class="info">
                <label for="">Nom : </label> RAMANANA <br>
                <label for="">Prénom : </label> RAMANANA <br>
                <label for="">code client : </label> CLT-2022-03-22353 <br>
            </div>
            <div class="info" id="tire">
                <button class="button">Tirage N° : </button>
            </div>
        </div>
        <div class="table-containt">
            <span class="caption">Numéro disponible : </span>
            <table class="table">
                <tbody>
                    <tr>
                        <td>1000</td>
                        <td>5656</td>
                        <td>2232</td>
                        <td>541514</td>
                        <td>1012</td>
                    </tr>
                    <tr>

                        <td>2148</td>
                        <td>21321</td>
                        <td>8787</td>
                        <td>4545</td>
                        <td> 898</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>