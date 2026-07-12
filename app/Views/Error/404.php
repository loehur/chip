<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Chip</title>
    <?php $this->headIcons(); ?>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { height: 100%; }
        body {
            font-family: 'DM Sans', -apple-system, sans-serif;
            background: #0a0a0b;
            color: #71717a;
            margin: 0;
            -webkit-font-smoothing: antialiased;
        }
        #main {
            display: table;
            width: 100%;
            height: 100vh;
            text-align: center;
        }
        .fof { display: table-cell; vertical-align: middle; }
        .fof h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #fafafa;
            display: inline-block;
            padding-right: 12px;
            animation: type .5s alternate infinite;
        }
        @keyframes type {
            from { box-shadow: inset -3px 0 0 #71717a; }
            to { box-shadow: inset -3px 0 0 transparent; }
        }
    </style>
</head>

<body>
<div id="main">
    <div class="fof">
        <h1>Error 404</h1>
    </div>
</div>
</body>
