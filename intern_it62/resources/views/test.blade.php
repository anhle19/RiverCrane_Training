<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="row mt-100">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Tooltip with image and content</h5>
                </div>
                <div class="card-block">
                    <p class="text-center">
                        <span class="mytooltip tooltip-effect-1">
                            <span class="tooltip-item">Hover me</span>
                            <span class="tooltip-content clearfix">
                                <img src="https://res.cloudinary.com/dxfq3iotg/image/upload/v1567228891/Untitled_design_6.png">
                                <span class="tooltip-text">Get the best way to find to eat icecream at BBBOOTSTRAP.COM</span>
                            </span>
                        </span>
                        to get tooltip with image and content
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    body {
        background-color: #E0E0E0
    }

    .mt-100 {
        margin-top: 150px;
        margin-left: 200px
    }

    .card-header {
        background-color: #9575CD
    }

    h5 {
        color: #fff
    }

    .card-block {
        margin-top: 10px
    }

    .mytooltip {
        display: inline;
        position: relative;
        z-index: 999
    }

    .mytooltip .tooltip-item {
        background: rgba(0, 0, 0, 0.1);
        cursor: pointer;
        display: inline-block;
        font-weight: 500;
        padding: 0 10px
    }

    .mytooltip .tooltip-content {
        position: absolute;
        z-index: 9999;
        width: 360px;
        left: 50%;
        margin: 0 0 20px -180px;
        bottom: 100%;
        text-align: left;
        font-size: 14px;
        line-height: 30px;
        -webkit-box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
        box-shadow: -5px -5px 15px rgba(48, 54, 61, 0.2);
        background: #2b2b2b;
        opacity: 0;
        cursor: default;
        pointer-events: none
    }

    .mytooltip .tooltip-content::after {
        content: '';
        top: 100%;
        left: 50%;
        border: solid transparent;
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-color: #2a3035 transparent transparent;
        border-width: 10px;
        margin-left: -10px
    }

    .mytooltip .tooltip-content img {
        position: relative;
        height: 140px;
        display: block;
        float: left;
        margin-right: 1em
    }

    .mytooltip .tooltip-item::after {
        content: '';
        position: absolute;
        width: 360px;
        height: 20px;
        bottom: 100%;
        left: 50%;
        pointer-events: none;
        -webkit-transform: translateX(-50%);
        transform: translateX(-50%)
    }

    .mytooltip:hover .tooltip-item::after {
        pointer-events: auto
    }

    .mytooltip:hover .tooltip-content {
        pointer-events: auto;
        opacity: 1;
        -webkit-transform: translate3d(0, 0, 0) rotate3d(0, 0, 0, 0deg);
        transform: translate3d(0, 0, 0) rotate3d(0, 0, 0, 0deg)
    }

    .mytooltip:hover .tooltip-content2 {
        opacity: 1;
        font-size: 18px
    }

    .mytooltip .tooltip-text {
        font-size: 14px;
        line-height: 24px;
        display: block;
        padding: 1.31em 1.21em 1.21em 0;
        color: #fff
    }
</style>

</html>